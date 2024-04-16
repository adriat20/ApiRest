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

$products_id  = file('../Products/product_ids.txt',FILE_IGNORE_NEW_LINES);
$product_id  = $products_id[1];

// Obtiene los detalles del producto
$product = $woocommerce->get('products/' . $product_id);

// Obtiene la cantidad de stock actual
$stock_quantity = $product->stock_quantity;

// Incrementa la cantidad de stock en 10
$stock_quantity += 10;

// Obtiene el estado del stock
$stock_status = $product->stock_status;

// Si la cantidad de stock es mayor que 0, establece el estado del stock en 'instock'
if ($stock_quantity > 0) {
    $stock_status = 'instock';
}

// Define los datos del producto
$product_data = [
    'stock_quantity' => $stock_quantity,
    'stock_status'   => $stock_status
];

// Actualiza el producto
$response = $woocommerce->put('products/' . $product_id, $product_data);

// Imprime la respuesta
print_r($response);


?>