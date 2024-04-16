<?php
// Requiere el archivo de carga automática de Composer
require __DIR__ . '/../vendor/autoload.php';

// Importa la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

// Define las claves de la API de WooCommerce
$consumer_key    = 'ck_1f11ce0d6ed2db83fa9fe951f02858c341128c58';
$consumer_secret = 'cs_50e6914c714bbfe9917f33526960454c6d945467';

// Crea una nueva instancia del cliente de WooCommerce
$woocommerce = new Client(
  'http://localhost/wordpress', // URL de tu tienda WooCommerce
  $consumer_key,
  $consumer_secret,
  [
    'version' => 'wc/v3', // Versión de la API de WooCommerce a utilizar
  ]
);

// Ruta al archivo que contiene los IDs de los productos
$product_ids_file = '../Products/product_ids.txt';

// Verifica si el archivo existe
if (!file_exists($product_ids_file)) {
    die('El archivo de IDs de productos no existe.');
}

// Lee los IDs de los productos desde el archivo
$products_ids = file($product_ids_file, FILE_IGNORE_NEW_LINES);

// Verifica si hay productos en el archivo
if (empty($products_ids)) {
    die('No se encontraron IDs de productos en el archivo.');
}

// Toma el primer ID de producto
$product_id = $products_ids[0]; // Cambiado a 0 para tomar el primer ID

// Datos de la revisión
$review_data = [
    'product_id'      => $product_id,
    'review'          => 'Camiseta barata y de mala calidad',
    'reviewer'        => 'Juan Juanito',
    'reviewer_email'  => 'juanitojuan@gmail.com',
    'rating'          => 2
];

try {
    // Realiza la llamada a la API para crear una nueva revisión
    $response = $woocommerce->post('products/reviews', $review_data);

    // Obtiene los detalles de la revisión
    $review_details = $woocommerce->get('products/reviews/' . $response->id);

    // Escribe el ID de la revisión en un archivo
    file_put_contents('reviews_id.txt', $response->id);

    // Imprime la respuesta de la creación de la revisión
    print_r($response);
} catch (Exception $e) {
    // Manejo de errores
    echo 'Error: ' . $e->getMessage();
}
?>
