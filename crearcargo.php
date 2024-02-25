<?php
require_once 'vendor/autoload.php';

\Stripe\Stripe::setApiKey("sk_test_51Ondf9E9Ro2mqoCeYkNSKhUqdiCBqLIDOOKLDy4T1rnHpn818WdlmlIo8U0ZextVRY3BatUkFXYf3ORXibGBgH9E00kN6Sib0v");

// Obtener el token de tarjeta de crédito enviado desde el formulario
$token = $_POST["stripeToken"];

// Verificar si el carrito existe en la sesión
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "Error: El carrito está vacío.";
    exit; // Detener la ejecución del script si el carrito está vacío
}

// Recuperar los detalles del carrito de la sesión
$carrito = $_SESSION['carrito'];

$line_items = array();

// Convertir los datos del carrito a enteros y agregarlos al array de line_items
foreach ($carrito as $producto) {
    // Convertir los datos a enteros
    $articulo_id = intval($producto['articulo_id']);
    $cantidad = intval($producto['cantidad']);
    $precio = intval($producto['precio']);
    $descuento = intval($producto['descuento']);
    
    // Agregar la línea de pedido al array de line_items
    $linea_pedido = [
        'price_data' => [
            'currency' => 'eur',
            'unit_amount' => $precio * 100, // El precio debe estar en centavos
            'product_data' => [
                'name' => $articulo_id,
            ],
        ],
        'quantity' => $cantidad,
    ];

    array_push($line_items, $linea_pedido);
}

try {
    // Crear el cargo en Stripe
    $charge = \Stripe\Charge::create([
        'amount' => calcularTotalCarrito() * 100, // El total debe estar en centavos
        'currency' => 'eur', // Cambiado a EUR para que coincida con la moneda de los ítems del carrito
        'source' => $token, // Token de tarjeta enviado desde el formulario
        'description' => 'Pago en mi tienda...', // Descripción del cargo
        
    ]);

    // Si el cargo se realiza correctamente, redirigir a una página de éxito o realizar otras acciones necesarias
    header("Location: pagoexitoso.php");
    exit; // Detener la ejecución del script después de redirigir
} catch (\Stripe\Exception\CardException $e) {
    // Error de la tarjeta
    $error = $e->getError()->message;
    echo "Error de la tarjeta: " . $error;
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Error de solicitud inválida
    echo "Error de solicitud inválida: " . $e->getMessage();
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Error de autenticación
    echo "Error de autenticación: " . $e->getMessage();
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Error de conexión a la API
    echo "Error de conexión a la API: " . $e->getMessage();
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Error genérico de la API de Stripe
    echo "Error de la API de Stripe: " . $e->getMessage();
} catch (Exception $e) {
    // Otros errores
    echo "Error desconocido: " . $e->getMessage();
}

// Función para calcular el total del carrito
function calcularTotalCarrito() {
    $total = 0;
    if(isset($_SESSION['carrito'])) {
        foreach($_SESSION['carrito'] as $linea_pedido) {
            $subtotal = calcularSubtotal($linea_pedido['cantidad'], $linea_pedido['precio'], $linea_pedido['descuento']);
            $total += $subtotal;
        }
    }
    return $total;
}

// Función para calcular el subtotal de una línea de pedido
function calcularSubtotal($cantidad, $precio, $descuento) {
    $subtotal = $cantidad * $precio;
    $subtotal -= $subtotal * ($descuento / 100); // Aplicar descuento si existe
    return $subtotal;
}
?>
