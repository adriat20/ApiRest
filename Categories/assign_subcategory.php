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