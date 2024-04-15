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

// Leer el archivo de IDs de productos
$products_ids = file('../Products/product_ids.txt', FILE_IGNORE_NEW_LINES);
$product_id = $products_ids[0]; // Se asume que el primer producto tiene un stock inicial de 100

// Obtener los detalles del producto
$product = $woocommerce->get('products/' . $product_id);

// Obtener la cantidad de stock actual y actualizarla
$stock_quantity = $product->stock_quantity;
$stock_quantity -= 8;

// Actualizar el estado del stock basado en la cantidad restante
if ($stock_quantity > 0) {
    $stock_status = 'instock';
} else {
    $stock_status = 'outofstock';
}

// Datos actualizados del producto
$product_data = [
    'stock_quantity' => $stock_quantity,
    'stock_status'   => $stock_status,
];

// Actualizar el producto
$response = $woocommerce->put('products/' . $product_id, $product_data);

// Imprimir la respuesta
print_r($response);
?>