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

// Lee los ID de los productos desde el archivo    
                                        //elimina los saltos de linea
$product_ids = file('product_ids.txt', FILE_IGNORE_NEW_LINES);

// Elimina el primer producto
$producto_id = $product_ids[0];
                                                        //la funcion force elimina
print_r($woocommerce->delete('products/'.$producto_id, ['force' => true]));
?>