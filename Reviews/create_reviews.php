<?php
// Requiere el archivo de carga automática de Composer
require __DIR__ . '/../vendor/autoload.php';

// Importa la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

// Define las claves de la API de WooCommerce
$consumer_key    = 'ck_9f614b3a23266982537042ecd33555551f03e686';
$consumer_secret = 'cs_da56f608ae29c4e52c397e11df758fd178d7506e';

// Crea una nueva instancia del cliente de WooCommerce
$woocommerce = new Client(
  'http://localhost/wordpress', // URL de tu tienda WooCommerce
  $consumer_key,
  $consumer_secret,
  [
    'version' => 'wc/v3', // Versión de la API de WooCommerce a utilizar
  ]
);

$products_id = file('../Products/product_ids.txt', FILE_IGNORE_NEW_LINES);
$product_id  = $products_id[1];

$review1 = [
    'product_id' => $product_id,
    'review' => 'Camiseta barata y de mala calidad',
    'reviewer' => 'Juan Juanito',
    'reviewer_email' => 'juanitojuan@gmail.com',
    'rating' => 2
];

// Realiza la llamada a la API para crear una nueva revisión
$response = $woocommerce->post('products/reviews', $review1);

// Obtiene los detalles de la revisión
$review_details = $woocommerce->get('products/reviews/' . $response->id);

// Escribe el ID de la revisión en un archivo
file_put_contents('reviews_id.txt', $response->id);

// Imprime la respuesta de la creación de la revisión
print_r($response);
?>