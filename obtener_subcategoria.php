<?php
session_start();
// Conexión a la base de datos
require "conexion.php";

   // Crear una instancia de la clase Database
   $database = new Database();

   // Obtener la conexión a la base de datos
   $conn = $database->getConnection();

// Verificar si se recibió el parámetro "categoria" en la solicitud POST
if(isset($_POST['categoria'])) {
    // Obtener la categoría seleccionada
    $categoriaSeleccionada = $_POST['categoria'];

    // Obtener subcategorías de la categoría seleccionada
    $stmt = $conn->prepare("SELECT codigo, nombre FROM subcategoria WHERE codCategoriaPadre = ?");
    $stmt->execute([$categoriaSeleccionada]);

    // Construir las opciones de subcategoría
    $options = "<option value=''>Selecciona una subcategoría</option>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options .= "<option value='{$row['codigo']}'>{$row['nombre']}</option>";
    }

    // Devolver las opciones de subcategoría como respuesta
    echo $options;
} else {
    // Si no se proporcionó el parámetro "categoria", devolver un mensaje de error
    echo "<option value=''>Error: No se proporcionó la categoría</option>";
}
?>