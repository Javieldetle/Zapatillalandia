<?php
// articulos.php

// Incluir el archivo de conexión a la base de datos
require 'conexion.php';
// Incluir el archivo que contiene la lógica para mostrar las imágenes
require 'mostrar_imagenes.php';

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión a la base de datos
$conn = $database->getConnection();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <!-- Agregar enlaces a archivos CSS si es necesario -->
</head>

<body>

    <section id="busqueda_articulo">
        <h2>Búsqueda de Artículo</h2>
        <!-- Formulario de Búsqueda de Artículo -->
        <form action="" method="get">
            <label for="busqueda">Buscar Artículo:</label>
            <input type="text" name="busqueda" id="busqueda" required>
            <input type="submit" value="Buscar">
        </form>
        <h2>Detalle del Artículo Seleccionado</h2>
        <!-- Código PHP para procesar la búsqueda y mostrar los resultados -->
        <?php
        // Conexión a la base de datos y consulta de artículos
        // Suponiendo que tienes un objeto $conn que representa la conexión a la base de datos
        if (isset($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $query = "SELECT a.codigo, a.nombre, a.descripcion, a.precio, a.imagen, c.codigo as codigo_categoria, c.nombre as nombre_categoria, s.codigo as codigo_subcategoria, s.nombre as nombre_subcategoria
                      FROM articulos a
                      LEFT JOIN categoria c ON a.categoria = c.codigo
                      LEFT JOIN subcategoria s ON a.subcategoria = s.codigo
                      WHERE a.nombre LIKE '%$busqueda%'";
            $result = $conn->query($query);

            // Mostrar resultados en forma de tabla
            if ($result) {
                if ($result->rowCount() > 0) {
                    echo "<h3>Resultados de la búsqueda:</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Imagen</th><th>Categoría</th><th>Subcategoría</th></tr>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['codigo'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['precio'] . "</td>";

                        // Obtener la ruta de la imagen usando la función definida en mostrar_imagenes.php
                        $ruta_imagen = obtenerRutaImagen($row['codigo_categoria'], $row['codigo_subcategoria'], $row['imagen']);

                        // Mostrar la imagen en la tabla
                        echo "<td><img src=\"$ruta_imagen\" alt=\"Imagen del artículo\" width='100'></td>";

                        // Mostrar categoría y subcategoría con su número y descripción
                        echo "<td>{$row['codigo_categoria']} - {$row['nombre_categoria']}</td>";
                        echo "<td>{$row['codigo_subcategoria']} - {$row['nombre_subcategoria']}</td>";

                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron resultados para la búsqueda: $busqueda</p>";
                }
            } else {
                echo "Error en la consulta: " . $conn->errorInfo()[2]; // Muestra el mensaje de error de la consulta
            }
        }
        ?>
    </section>
</body>

</html>
