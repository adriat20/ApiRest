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
    'http://localhost/wordpress', 
    $consumer_key,
    $consumer_secret,
    [
        'version' => 'wc/v3', // Versión de la API de WooCommerce
    ]
);

$subcategory_data = [
    'name' => 'Pijamas', // Nombre de la subcategoría
    'image' => [ // Imagen de la subcategoría
        'src' => 'https://m.media-amazon.com/images/I/714-ebwmihS._AC_UF894,1000_QL80_.jpg'
    ]
];

$response = $woocommerce->post('products/categories', $subcategory_data);
file_put_contents("subcategories_id.txt", $response->id, FILE_IGNORE_NEW_LINES);



print_r($response);

?>