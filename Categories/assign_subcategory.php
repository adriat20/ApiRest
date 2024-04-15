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

//Recoge el txt de categorias
$categories_id = file('categories_id.txt',FILE_IGNORE_NEW_LINES);

//Recoge el txt de subcategorias
$subcategories_id = file('subcategories_id.txt',FILE_IGNORE_NEW_LINES);

//Recoge el txt de productos
$products_id  = file('../Products/product_ids.txt',FILE_IGNORE_NEW_LINES);

$category_id   = $categories_id[0]; // Obtiene el primer ID de categoria
$subcategory_id   = $subcategories_id[0]; // Obtiene el primer ID de subcategoria
$product_id   = $products_id[0]; // Obtiene el primer ID del producto

$product_data = [
    'categories' => [ // Categorías del producto
        [
            'id' => $category_id // corresponde con la categoría "Camisetas"
        ],
        [
            'id' => $subcategory_id // corresponde con la subcategoría "Pijamas"
        ]
    ]
];

$response = $woocommerce->put('products/' . $product_id, $product_data);


?>