<?php
session_start(); // Iniciar sesión
// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    // Redirigir a la página de inicio o mostrar un mensaje de error
    header("Location: index.php");
    exit();
}

// Aquí puedes agregar el código PHP para procesar el formulario de agregar usuario
// y realizar la inserción en la base de datos
?>
