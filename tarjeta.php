<style>
    .card {
        height: 100%;
    }

    .card-body {
        background-color: #f8f9fa; /* Color de fondo gris claro */
        height: 100%;
    }
    .row {
            display: flex;
            flex-wrap: wrap;
        }

        .card-descuento {

            background-color: #ff0000;
            /* Fondo rojo */
            color: #ffffff;
            /* Texto blanco */
            padding: 5px;
            /* Espaciado interno */
            border-radius: 5px;
            /* Bordes redondeados */
            margin-bottom: 20px;
            /* Espacio inferior */
            width: fit-content;
            /* Ancho ajustado al contenido */
            text-align: center;
            /* Centrado horizontal */



        }

        .card-body {
            flex: 1;
            /* La parte del cuerpo de la tarjeta ocupa todo el espacio disponible */
        }

        .card-text {
            margin-bottom: 2;
            /* Eliminar el margen inferior de los párrafos */
        }

        .card-discount {
            background-color: #ff0000;
            /* Fondo rojo */
            color: #ffffff;
            /* Texto blanco */
            padding: 1px 2px;
            /* Espaciado interno */
            border-radius: 5px;
            /* Bordes redondeados */
            margin-bottom: 10px;
            /* Espacio inferior */

            max-width: fit-content;
            margin-left: 220px;


        }

        #cart-icon {
            color: black;
            /* Color blanco por defecto */
            font-size: 80px;
        }

        #cart-link:hover #cart-icon {
            color: lightgreen;
            /* Color verde al pasar el cursor sobre el enlace */
        }
</style>

<!-- Sección de visualización de Artículos -->
<div class="col-md-12 order-md-2" style="text-align:center;">
    <!-- Mostrar todos los artículos -->
    <div class="row">
        <?php
       
        // Incluir el archivo de conexión a la base de datos
        include_once 'conexion.php';

        // Crear una instancia de la clase Database
        $database = new Database();

        // Obtener la conexión
        $conn = $database->getConnection();

        // Definir el número de artículos por página
        $articulosPorPagina = 6;

        // Calcular el índice de inicio para la consulta según la página actual
        $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
        $indiceInicio = ($paginaActual - 1) * $articulosPorPagina;

        // Consulta SQL para obtener todos los artículos paginados
        $query = "SELECT * FROM articulos WHERE activo = 1 LIMIT $indiceInicio, $articulosPorPagina";

        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <?php foreach ($articulos as $articulo) : ?>
            <?php
            // Verificar si el artículo pertenece a la categoría y subcategoría seleccionadas
            if (($categoriaSeleccionada === 'todos' || $articulo['categoria'] == $categoriaSeleccionada) &&
                ($subcategoriaSeleccionada === 'todos' || $articulo['subcategoria'] == $subcategoriaSeleccionada)
            ) {
                // Definir la ruta base según la categoría y subcategoría
                $ruta_base = '';

                // Consultar el nombre de la categoría y subcategoría
                $query_categorias = "SELECT nombre FROM categoria WHERE codigo = :categoria";
                $query_subcategorias = "SELECT nombre FROM subcategoria WHERE codigo = :subcategoria";

                // Preparar y ejecutar las consultas para categoría y subcategoría
                $stmt_categoria = $conn->prepare($query_categorias);
                $stmt_categoria->bindParam(':categoria', $articulo['categoria']);
                $stmt_categoria->execute();
                $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);

                $stmt_subcategoria = $conn->prepare($query_subcategorias);
                $stmt_subcategoria->bindParam(':subcategoria', $articulo['subcategoria']);
                $stmt_subcategoria->execute();
                $subcategoria = $stmt_subcategoria->fetch(PDO::FETCH_ASSOC);

                // Verificar si se encontraron los nombres de categoría y subcategoría
                if ($categoria && $subcategoria) {
                    // Concatenar el nombre de la categoría y subcategoría a la ruta base
                    $ruta_base = 'img/' . $categoria['nombre'] . '/' . $subcategoria['nombre'] . '/';
                }

                // Concatenar el nombre de la imagen a la ruta base
                $ruta_imagen = $ruta_base . $articulo['imagen'];
            }
            ?>

            <div class="col-sm-4 mb-4">
                <div class="card">
                    <!-- Mostrar la imagen -->
                    <img src="<?php echo $ruta_imagen; ?>" class="card-img-top" alt="<?php echo $articulo['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $articulo['nombre']; ?></h5>
                        <p class="card-text"><?php echo $articulo['descripcion']; ?></p>
                        <p class="card-text"><?php echo "Precio: € " . $articulo['precio']; ?></p>
                        <?php if ($articulo['descuento'] > 0) : ?>
                            <p class="card-descuento"><?php echo "Descuento: %" . $articulo['descuento']; ?></p>
                        <?php endif; ?>
                        <!-- Formulario para agregar al carrito -->
                        <form action="carrito.php" method="post">
                            <input type="hidden" name="articulo_id" value="<?php echo $articulo['codigo']; ?>">
                            <input type="hidden" name="precio" value="<?php echo $articulo['precio']; ?>">
                            <input type="hidden" name="descuento" value="<?php echo $articulo['descuento']; ?>">
                            <input type="hidden" name="cod_usuario" value="<?php echo $dni_usuario; ?>">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" value="1" min="1" style="width: 2.5em;"><br><br>
                            <button type="submit" name="agregar_al_carrito" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div> <!-- Cierre de card-body -->
                </div> <!-- Cierre de card -->
            </div> <!-- Cierre de col -->
        <?php endforeach; ?> <!-- Cierre de foreach -->
    </div> <!-- Cierre de row -->
</div> <!-- Cierre de col -->

<?php
// Incluir el archivo de conexión a la base de datos
include_once 'conexion.php';

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión
$conn = $database->getConnection();




// Obtener la página actual
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcular el índice de inicio para la consulta según la página actual
$indiceInicio = ($paginaActual - 1) * $articulosPorPagina;


// Mostrar solo los enlaces a páginas si hay más de una página
if ($totalPaginas > 0) {
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-center mt-4">';

    // Botón "Anterior"
    if ($paginaActual > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($paginaActual - 1) . '">Anterior</a></li>';
    }

    // Enlaces a las páginas
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo '<li class="page-item ' . ($i == $paginaActual ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }

    // Botón "Siguiente"
    if ($paginaActual < $totalPaginas) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($paginaActual + 1) . '">Siguiente</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
}

// Ahora puedes mostrar los artículos filtrados en tu página

?>