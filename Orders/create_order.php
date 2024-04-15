<?php

require __DIR__ . '/../vendor/autoload.php';
include '../utils/regex.php';

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

$order1 = [
    'payment_method' => 'bacs',
    'payment_method_title' => 'Direct Bank Transfer',
    'set_paid' => true,
    'billing' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'dni'       => validarDni('12345678Z'),
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US',
        'email' => 'john.doe@example.com',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US'
    ],
    'line_items' => [
        [
            'product_id' => 93,
            'quantity' => 2
        ],
        [
            'product_id' => 22,
            'variation_id' => 23,
            'quantity' => 1
        ]
    ],
    'shipping_lines' => [
        [
            'method_id' => 'flat_rate',
            'method_title' => 'Flat Rate',
            'total' => '10.00'
        ]
    ]
];

$order2 = [
    'payment_method' => 'bacs',
    'payment_method_title' => 'Transferencia Bancaria Directa',
    'set_paid' => true,
    'billing' => [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'dni' => validarDni('458976554S'),
        'address_1' => 'Calle de Ejemplo, 123',
        'address_2' => '',
        'city' => 'Ciudad Ejemplo',
        'state' => 'Ejemplo',
        'postcode' => '12345',
        'country' => 'ES',
        'email' => 'juan.perez@example.com',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'address_1' => 'Calle de Ejemplo, 123',
        'address_2' => '',
        'city' => 'Ciudad Ejemplo',
        'state' => 'Ejemplo',
        'postcode' => '12345',
        'country' => 'ES'
    ],
    'line_items' => [
        [
            'product_id' => 93,
            'quantity' => 2
        ],
        [
            'product_id' => 22,
            'variation_id' => 23,
            'quantity' => 1
        ]
    ],
    'shipping_lines' => [
        [
            'method_id' => 'flat_rate',
            'method_title' => 'Tarifa Plana',
            'total' => '10.00'
        ]
    ]
];

$response1 = $woocommerce -> post('orders',$order1);
$response2 = $woocommerce->post('orders', $order2);
file_put_contents('order_ids.txt',$response1->id. PHP_EOL . $response2->id);

print_r($response1);
print_r($response2);
?>