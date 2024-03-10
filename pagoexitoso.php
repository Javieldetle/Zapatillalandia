<?php
// Incluir el archivo de funciones del carrito
require_once 'carrito.php';
require_once 'conexion.php';
session_start();
// Obtener el ID del pedido de la sesión
$idPedido = $_SESSION['id_pedido'];

// Función para actualizar el estado del pedido en la base de datos
function actualizarEstadoPedido($idPedido) {
    // Establecer la conexión a la base de datos
    $conexion = new Database();
    $conn = $conexion->getConnection();

    try {
        // Preparar la consulta SQL para actualizar el estado del pedido
        $stmt = $conn->prepare("UPDATE pedidos SET estado = 1 WHERE idpedido = :idPedido");
        // Vincular el parámetro ID del pedido
        $stmt->bindParam(':idPedido', $idPedido);
        // Ejecutar la consulta
        $stmt->execute();
        
        // Si la consulta se ejecuta correctamente, retornar true para indicar éxito
        return true;
    } catch (PDOException $e) {
        // Si ocurre algún error durante la ejecución de la consulta, mostrar el mensaje de error
        echo "Error al actualizar el estado del pedido: " . $e->getMessage();
        // Retornar false para indicar que ha ocurrido un error
        return false;
    }
}

// Llamar a la función para actualizar el estado del pedido
actualizarEstadoPedido($idPedido);

// Vaciar el carrito después de realizar el pago exitoso
vaciarCarrito();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <script>
        // Función para redireccionar a la página de inicio después de 5 segundos
        setTimeout(function() {
            window.location.href = 'index.php'; // Cambia 'index.php' por la URL deseada
        }, 5000); // 5000 milisegundos = 5 segundos
    </script>
</head>
<body>
    <h1>Pago Exitoso</h1>
    <p>Tu pago se ha procesado correctamente. Serás redirigido a la página de inicio en unos segundos.</p>
    <p>Si no eres redirigido automáticamente, <a href="index.php">haz clic aquí</a>.</p>
</body>
</html>
