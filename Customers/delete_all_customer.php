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

foreach($customers_ids as $delete){
    try {
        $response = $woocommerce->delete('customers/'.$delete, ['force' => true]);
        echo "Cliente con ID $delete eliminado correctamente.\n";
    } catch (Exception $e) {
        echo "Error al eliminar el cliente con ID $delete: ",  $e->getMessage(), "\n";
    }
}
?>