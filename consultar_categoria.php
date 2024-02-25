<?php
include 'conexion.php';

// Consulta para obtener las categorías principales
$consulta_categorias = "SELECT * FROM categoria WHERE codCategoriaPadre IS NULL";
$resultado_categorias = $conn->query($consulta_categorias);

if ($resultado_categorias->num_rows > 0) {
    // Mostrar las categorías principales
    while($fila = $resultado_categorias->fetch_assoc()) {
        echo "<li>" . $fila["nombre"] . "</li>";

        // Consultar subcategorías si existen
        $consulta_subcategorias = "SELECT * FROM categoria WHERE codCategoriaPadre = " . $fila["codigo"];
        $resultado_subcategorias = $conn->query($consulta_subcategorias);
        if ($resultado_subcategorias->num_rows > 0) {
            echo "<ul>";
            while($subfila = $resultado_subcategorias->fetch_assoc()) {
                echo "<li>" . $subfila["nombre"] . "</li>";
            }
            echo "</ul>";
        }
    }
}
?>
