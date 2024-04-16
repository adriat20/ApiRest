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

//te traes nuevamente el fichero donde escribes el txt de los productos e ids
$products_id = file('product_ids.txt',FILE_IGNORE_NEW_LINES);
   
    

$data = [
    'name' => 'Camiseta sin mangas', // Nombre del producto
    'type' => 'simple', // Tipo de producto
    'regular_price' => '8.40', // Precio regular del producto
    'description' => 'Camiseta sin mangas, de gymbro total.', // Descripción del producto
    'short_description' => 'Camiseta sin mangas',
    'categories' => [ // Categorías del producto
        [
            'id' => 1 // corresponde con la categoría principal (camisetas)
        ],
        [
            'id' => 4 // corresponde con la subcategoría (sin mangas)
        ]
    ],
    'images' => [ // Imágenes del producto
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_6_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_6_back.jpg'
        ]
    ]
];

// --- ACTUALIZA UNO ---
$producto_id = $products_id[1];
print_r($woocommerce -> put ('products/'.$producto_id,$data));

// --- ACTUALIZA TODOS ---

//foreach ($products_id as $producto_id){
//    print_r($woocommerce->put('products/'.$producto_id, $data));
//}


?>