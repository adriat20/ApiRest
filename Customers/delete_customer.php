
<?php

require __DIR__ . '/../vendor/autoload.php';


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


// Leer el archivo de IDs de clientes
$customers_ids = file('customer_ids.txt', FILE_IGNORE_NEW_LINES);
$customer_id   = $customers_ids[1];

// Eliminar el cliente
print_r($woocommerce->delete('customers/'.$customer_id, ['force' => true]));

?>