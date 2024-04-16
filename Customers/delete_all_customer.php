<?php

require __DIR__ . '/../vendor/autoload.php';

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