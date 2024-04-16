<?php

require __DIR__ . '/../vendor/autoload.php';

// Importa la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

// Define las claves de la API de WooCommerce
$consumer_key    = 'ck_1f11ce0d6ed2db83fa9fe951f02858c341128c58';
$consumer_secret = 'cs_50e6914c714bbfe9917f33526960454c6d945467';

try {
    // Crea una nueva instancia del cliente de WooCommerce
    $woocommerce = new Client(
        'http://localhost/wordpress', // URL de tu tienda WooCommerce
        $consumer_key,
        $consumer_secret,
        [
            'version' => 'wc/v3', // Versión de la API de WooCommerce a utilizar
        ]
    );

    // Leer los IDs de pedido y cliente desde archivos
    $order_ids = file('order_ids.txt', FILE_IGNORE_NEW_LINES);
    $order_id = $order_ids[0];

    $customer_ids = file('../Customers/customer_ids.txt', FILE_IGNORE_NEW_LINES);
    $customer_id = $customer_ids[0];

    // Obtener los pedidos del cliente específico
    $response = $woocommerce->get('orders', ['customer' => $customer_id]);

    // Imprimir la respuesta
    print_r($response);
} catch (Exception $e) {
    // Captura cualquier excepción y muestra un mensaje de error
    echo "Error: " . $e->getMessage();
}

?>