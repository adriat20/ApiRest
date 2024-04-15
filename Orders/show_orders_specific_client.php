<?php

require __DIR__ . '/../vendor/autoload.php';

// Importa la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

// Define las claves de la API de WooCommerce
$consumer_key    = 'ck_9f614b3a23266982537042ecd33555551f03e686';
$consumer_secret = 'cs_da56f608ae29c4e52c397e11df758fd178d7506e';

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
    $order_id = $order_ids[1];

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