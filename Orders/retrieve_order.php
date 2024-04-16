<?php

//Este archivo permite que se carguen las opciones de WP en local
require( 'C:/xampp/htdocs/wordpress/wp-load.php' );

require __DIR__ . '/../vendor/autoload.php';

// Importar la clase Cliente de WooCommerce
use Automattic\WooCommerce\Client;

try{
    // Define las claves de la API de WooCommerce
    $consumer_key    = 'ck_1f11ce0d6ed2db83fa9fe951f02858c341128c58';
    $consumer_secret = 'cs_50e6914c714bbfe9917f33526960454c6d945467';

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
    $order_id  = $order_ids[0]; 

    $customer_ids = file('../Customers/customer_ids.txt', FILE_IGNORE_NEW_LINES);
    $customer_id  = $customer_ids[0]; 

    $order = $woocommerce->get('orders/'.$order_id);
    $customer = $woocommerce->get('customers/'.$customer_id);

    // El DNI del pedido
    $dni_pedido = isset($order->meta_data[0]->value) ? $order->meta_data[0]->value : 'DNI no encontrado';
    // El DNI del cliente
    $dni_cliente = isset($customer->meta_data[0]->value) ? $customer->meta_data[0]->value : 'DNI no encontrado';
    
    // Compara los DNIs y los imprime solo si son iguales
    if ($dni_pedido != 'DNI no encontrado' && $dni_cliente != 'DNI no encontrado' && $dni_pedido == $dni_cliente) {
        echo "¡Acceso satisfactorio, los DNIs son iguales!<br><br>";
        echo "<strong>DNI del pedido: " . $dni_pedido . "</strong><br>";
        echo "<strong>DNI del cliente: " . $dni_cliente . "</strong><br><br>";

        // Imprimir campos específicos del cliente
        echo "Detalles del cliente:<br>";
        echo "Nombre: " . $customer->first_name . " " . $customer->last_name . "<br>";
        echo "Email: " . $customer->email . "<br>";
        // Agrega más campos específicos del cliente aquí si los necesitas

        echo "<br>";

        // Imprimir campos específicos del pedido
        echo "Detalles del pedido:<br>";
        echo "Fecha del pedido: " . $order->date_created . "<br>";
        // Agrega más campos específicos del pedido aquí si los necesitas
    } else {
        echo "Los DNIs no son iguales o alguno de los DNIs no está disponible.";
    }

} catch (Exception $e) {
    echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
}

?>