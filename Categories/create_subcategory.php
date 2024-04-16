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