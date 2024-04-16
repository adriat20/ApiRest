<?php
// Se incluyen las dependencias necesarias
require __DIR__ . '/../vendor/autoload.php';

// Se utiliza la clase Client de WooCommerce
use Automattic\WooCommerce\Client;

// Se definen las claves de la API de WooCommerce
$consumer_key    = 'ck_1f11ce0d6ed2db83fa9fe951f02858c341128c58';
$consumer_secret = 'cs_50e6914c714bbfe9917f33526960454c6d945467';

// Se crea una nueva instancia del cliente de WooCommerce
$woocommerce = new Client(
  'http://localhost/wordpress',
  $consumer_key,
  $consumer_secret,
  [
    'version' => 'wc/v3',
  ]
);

// Obtiene todos los clientes
$customers_ids = file('../Customers/customer_ids.txt', FILE_IGNORE_NEW_LINES);

$max_pedidos = 0;
$cliente_max_pedidos = null;

// Recorre cada cliente
foreach ($customers_ids as $customer_id) {
    // Obtiene todos los pedidos del cliente
    $response_orders = $woocommerce->get('orders', ['customer' => $customer_id]);

    // Obtiene el número total de pedidos del cliente
    $total_orders = count($response_orders);

    // Si el cliente tiene más pedidos que el máximo actual, se actualiza el máximo
    if ($total_orders > $max_pedidos) {
        $max_pedidos = $total_orders;
        $cliente_max_pedidos = $customer_id;
    }
}

// Si se encontró un cliente con pedidos
if ($cliente_max_pedidos !== null) {
    // Muestra el cliente con el mayor número de pedidos
    echo "El cliente con el mayor número de pedidos es: " . $cliente_max_pedidos;
    echo " Con un total de: " . $max_pedidos . " pedidos.";
} else {
    // Si no se encontró ningún cliente con pedidos, muestra un mensaje
    echo "No se encontró ningún cliente con pedidos.";
}
?>
