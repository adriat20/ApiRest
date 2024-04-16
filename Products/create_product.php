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

// Define los datos del producto
$product1 = [
    'name' => 'Camiseta básica', // Nombre del producto
    'type' => 'simple', // Tipo de producto
    'regular_price' => '27.40', // Precio regular del producto
    'description' => 'Camiseta básica. Pues eso, básica.', // Descripción del producto
    'short_description' => 'Camiseta básica', // Descripción corta del producto
    'categories' => [ // Categorías del producto
        [
            'id' => 1 // corresponde con la categoría principal (camisetas)
        ],
        [
            'id' => 1 // corresponde con la subcategoría (simples)
        ]
    ],
    'images' => [ // Imágenes del producto
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
        ]
    ],
    'stock_quantity' => 1,
    'stock_status' => 'instock' // Estado del stock del producto
];

$product2 = [
    'name' => 'Camiseta deportiva', // Nombre del producto
    'type' => 'simple', // Tipo de producto
    'regular_price' => '40.89', // Precio regular del producto
    'description' => 'Camiseta deportiva, barata y confortable', // Descripción del producto
    'short_description' => 'Camiseta deportiva', // Descripción corta del producto
    'categories' => [ // Categorías del producto
        [
            'id' => 1 // corresponde con la categoría principal (camisetas)
        ],
        [
            'id' => 2 // corresponde con la subcategoría (deporte)
        ]
    ],
    'images' => [ // Imágenes del producto
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_1_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_1_back.jpg'
        ]
    ],
    'stock_quantity' => 0,
    'stock_status' => 'outofstock' // Estado del stock del producto
];

$product3  = [
    'name' => 'Camiseta de seda', // Nombre del producto
    'type' => 'simple', // Tipo de producto
    'regular_price' => '33.33', // Precio regular del producto
    'description'   => 'Camiseta de seda, muy cómoda', // Descripción del producto
    'short_description' => 'Camiseta de seda', // Descripción corta del producto
    'categories' => [ // Categorías del producto
        ['id' => 1],
        ['id' => 3]
    ],
    'images' => [ // Imágenes del producto
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_3_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_3_back.jpg'
        ]
    ],
    'stock_quantity' => 8,
    'stock_status' => 'instock' // Estado del stock del producto
];

// Crea los productos en WooCommerce
$response1 = $woocommerce->post('products', $product1);

$response2 = $woocommerce->post('products',$product2);

$response3 = $woocommerce->post('products', $product3);


// Escribe datos en un archivo
    //aqui se escriben los datos   //contiene el primer  //PHP_EOL es un salto de linea
                                  // producto creado     
file_put_contents('product_ids.txt', $response1->id . PHP_EOL . $response2->id. PHP_EOL . $response3->id);
?>