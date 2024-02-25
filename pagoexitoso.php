<?php
// Incluir el archivo de funciones del carrito
require_once 'carrito.php';

// Vaciar el carrito después de realizar el pago exitoso
vaciarCarrito();

// Realizar cualquier otro procesamiento necesario para el pago exitoso

// Redirigir a la página de inicio después de un breve retraso
header("refresh:5;url=index.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
</head>
<body>
    <h1>Pago Exitoso</h1>
    <p>Tu pago se ha procesado correctamente. Serás redirigido a la página de inicio en unos segundos.</p>
    <p>Si no eres redirigido automáticamente, <a href="index.php">haz clic aquí</a>.</p>
</body>
</html>