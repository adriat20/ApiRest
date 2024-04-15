<?php

require __DIR__ . '/../vendor/autoload.php';
include '../utils/regex.php';

use Automattic\WooCommerce\Client;


$consumer_key    = 'ck_9f614b3a23266982537042ecd33555551f03e686';
$consumer_secret = 'cs_da56f608ae29c4e52c397e11df758fd178d7506e';


$woocommerce = new Client(
  'http://localhost/wordpress', 
  $consumer_key,
  $consumer_secret,
  [
    'version' => 'wc/v3', 
  ]
);

$customer1 = [
    'email' => 'john.doe@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'dni'       => validarDni('12345678Z'),
    'username' => 'john.doe',
    'billing' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'company' => '',
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
        'company' => '',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US'
    ]
];

$customer2 = [
    'email' => 'juanito.perez@example.com',
    'first_name' => 'Juan',
    'last_name' => 'Pérez',
    'username' => 'juanito.perez',
    'billing' => [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'company' => '',
        'address_1' => 'Calle Falsa 123',
        'address_2' => '',
        'city' => 'Ciudad Ficticia',
        'state' => 'Estado Ficticio',
        'postcode' => '12345',
        'country' => 'US',
        'email' => 'juanito.perez@example.com',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'company' => '',
        'address_1' => 'Calle Falsa 123',
        'address_2' => '',
        'city' => 'Ciudad Ficticia',
        'state' => 'Estado Ficticio',
        'postcode' => '12345',
        'country' => 'US'
    ]
];


//Crea los clientes mediante la respuesta de la API
$response1 = $woocommerce->post('customers', $customer1);
$response2 = $woocommerce->post('customers', $customer2);


file_put_contents('customer_ids.txt', $response1->id . PHP_EOL . $response2->id);

print_r($response1);
print_r($response2);


?>