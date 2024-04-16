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

// Lee los ID de los productos desde el archivo    
                                        //elimina los saltos de linea
$product_ids = file('product_ids.txt', FILE_IGNORE_NEW_LINES);

// Elimina el primer producto
$producto_id = $product_ids[0];
                                                        //la funcion force elimina
print_r($woocommerce->delete('products/'.$producto_id, ['force' => true]));
?>