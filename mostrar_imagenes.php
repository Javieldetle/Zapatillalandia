<?php

// Conexión a la base de datos
require_once 'conexion.php'; // Asegúrate de incluir el archivo de conexión a la base de datos

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión a la base de datos
$conn = $database->getConnection();

// Función para obtener la ruta de la imagen según la categoría y subcategoría
function obtenerRutaImagen($categoria, $subcategoria, $imagen, $conn) {
    // Definir la ruta base para las imágenes
    $ruta_base = "img/";

    // Añadir la categoría y subcategoría a la ruta base
    $ruta_base .= obtenerNombreCategoria($categoria, $conn) . "/";
    $ruta_base .= obtenerNombreSubcategoria($subcategoria, $conn) . "/";

    // Concatenar el nombre de la imagen a la ruta base
    $ruta_imagen = $ruta_base . $imagen;

    return $ruta_imagen;
}

// Función para obtener el nombre de la categoría según su código
function obtenerNombreCategoria($codigo_categoria, $conn) {
    try {
        $stmt = $conn->prepare("SELECT nombre FROM categoria WHERE codigo = ?");
        $stmt->execute([$codigo_categoria]);
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($categoria) {
            return $categoria['nombre'];
        } else {
            return ""; // Si no se encuentra la categoría, devuelve una cadena vacía
        }
    } catch (PDOException $e) {
        echo "Error al obtener el nombre de la categoría: " . $e->getMessage();
        return ""; // En caso de error, devuelve una cadena vacía
    }
}

// Función para obtener el nombre de la subcategoría según su código
function obtenerNombreSubcategoria($codigo_subcategoria, $conn) {
    try {
        $stmt = $conn->prepare("SELECT nombre FROM subcategoria WHERE codigo = ?");
        $stmt->execute([$codigo_subcategoria]);
        $subcategoria = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($subcategoria) {
            return $subcategoria['nombre'];
        } else {
            return ""; // Si no se encuentra la subcategoría, devuelve una cadena vacía
        }
    } catch (PDOException $e) {
        echo "Error al obtener el nombre de la subcategoría: " . $e->getMessage();
        return ""; // En caso de error, devuelve una cadena vacía
    }
}

// Obtener todos los artículos existentes en la base de datos
$stmt = $conn->query("SELECT codigo, nombre, categoria, subcategoria FROM articulos");
$articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
