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

$category1 = [
    'name' => 'Camisetas',
    'image' => [
        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_7_front.jpg'
    ]
];

$category2 = [
    'name' => 'Servilletas',
    'image' => [
        'src' => 'https://www.4webs.es/blog/wp-content/uploads/2019/02/urls-que-es.jpg'
    ]
];

$response1 = $woocommerce->post('products/categories', $category1);
$response2 = $woocommerce->post('products/categories', $category2);

// Crea un fichero para almacenar las categorias
file_put_contents('categories_id.txt', $response1->id. PHP_EOL . $response2->id);

// Recupera los detalles de la categoría 1
$category_details1 = $woocommerce->get('products/categories/' . $response1->id);

// Recupera los detalles de la categoría 2
$category_details2 = $woocommerce->get('products/categories/' . $response2->id);

// Imprime los detalles de las categorías
print_r($category_details1);
print_r($category_details2);
?>