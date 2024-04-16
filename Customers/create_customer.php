<?php

require( 'C:/xampp/htdocs/wordpress/wp-load.php' );
require __DIR__ . '/../vendor/autoload.php';
include '../Utils/regex.php';

include '../Utils/regex.php';
use Automattic\WooCommerce\Client;


$consumer_key    = 'ck_1f11ce0d6ed2db83fa9fe951f02858c341128c58';
$consumer_secret = 'cs_50e6914c714bbfe9917f33526960454c6d945467';


$woocommerce = new Client(
  'http://localhost/wordpress', 
  $consumer_key,
  $consumer_secret,
  [
    'version' => 'wc/v3', 
  ]
);

//creo un cliente con un campo personalizado
$customer1 = [
    'email'     => 'john.doe@example.com',
    'first_name'=> 'John',
    'last_name' => 'Doe',
    'meta_data' => [
        [
            'key'   => 'dni_pedido',
            'value' =>  validarDNI('12345678Z')
        ]
    ],
    'username'  => 'john.doe',
    'billing'   => [
        'first_name' => 'John',
        'last_name'  => 'Doe',
        'company'    => '',
        'address_1'  => '969 Market',
        'city'       => 'San Francisco',
        'state'      => 'CA',
        'postcode'   => '94103',
        'country'    => 'US',
        'email'      => 'john.doe@example.com',
        'phone'      => '(555) 555-5555'
    ],
    'shipping'  => [
        'first_name' => 'John',
        'last_name'  => 'Doe',
        'company'    => '',
        'address_1'  => '969 Market',
        'address_2'  => '',
        'city'       => 'San Francisco',
        'state'      => 'CA',
        'postcode'   => '94103',
        'country'    => 'US'
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

// Accede al campo personalizado 'dni_pedido'
$dni_pedido = '';
foreach ($response1->meta_data as $meta_data) {
    if ($meta_data->key == 'dni_pedido') {
        $dni_pedido = $meta_data->value;
        break;
    }
}

// Imprime el DNI del cliente
echo '<strong>El DNI del pedido es: ' . $dni_pedido.'</strong>';

?>