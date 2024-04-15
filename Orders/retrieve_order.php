<?php

// Requerir el archivo de carga automática de Composer
require __DIR__ . '/../vendor/autoload.php';

// Importar la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

try {
    // Define las claves de la API de WooCommerce
    $consumer_key    = 'ck_9f614b3a23266982537042ecd33555551f03e686';
    $consumer_secret = 'cs_da56f608ae29c4e52c397e11df758fd178d7506e';

    // Crear una nueva instancia del cliente de WooCommerce
    $woocommerce = new Client(
      'http://localhost/wordpress', // URL de tu tienda WooCommerce
      $consumer_key,
      $consumer_secret,
      [
        'version' => 'wc/v3', // Versión de la API de WooCommerce a utilizar
      ]
    );

    $order_ids = file('order_ids.txt', FILE_IGNORE_NEW_LINES);
    $order_id  = $order_ids[1];

    $customer_ids = file('../Customers/customer_ids.txt', FILE_IGNORE_NEW_LINES);
    $customer_id  = $customer_ids[0];

    $order = $woocommerce->get('orders/'.$order_id);
    $customer = $woocommerce->get('customers/'.$customer_id);

 
    // Accede al campo DNI del cliente y del pedido
    $dni_order = property_exists($order->billing, 'dni') ? $order->billing->dni : null;
    $dni_customer = property_exists($customer->billing, 'dni') ? $customer->billing->dni : null;


    // Compara los DNIs e imprime el pedido si coinciden
    if ($dni_customer == $dni_order) {
        print_r($order);
        echo '<br><strong>El DNI del cliente y el DNI del pedido son iguales.</strong>';
    } else {
        echo '<br><strong>El DNI del cliente y el DNI del pedido no son iguales.</strong>';
    }
    

} catch (Exception $e) {
    echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
}
?>
