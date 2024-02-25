<?php
session_start(); // Iniciar sesión si no se ha iniciado

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: index.php");
exit(); // Terminar el script después de redirigir
?>
