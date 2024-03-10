<?php

session_start();
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
$subcategoriaSeleccionada = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : 'todos';

require 'conexion.php';

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión a la base de datos
$conn = $database->getConnection();

// Definir el número de artículos por página
$articulosPorPagina = 6; // Cambiado de 4 a 6

// Obtener la página actual
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcular el offset para la consulta SQL
$offset = ($paginaActual - 1) * $articulosPorPagina;

// Consulta SQL para obtener el total de artículos
$queryTotal = "SELECT COUNT(*) as total FROM articulos";
$resultTotal = $conn->query($queryTotal);
$totalArticulos = $resultTotal->fetch(PDO::FETCH_ASSOC)['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalArticulos / $articulosPorPagina);

// Consulta SQL para obtener los artículos de la página actual
$query = "SELECT * FROM articulos";

// Agregar condiciones para la categoría y subcategoría seleccionadas
if ($categoriaSeleccionada !== 'todos') {
    $query .= " WHERE categoria = $categoriaSeleccionada";
    if ($subcategoriaSeleccionada !== 'todos') {
        $query .= " AND subcategoria = $subcategoriaSeleccionada";
    }
} elseif ($subcategoriaSeleccionada !== 'todos') {
    $query .= " WHERE subcategoria = $subcategoriaSeleccionada";
}

// Agregar LIMIT y OFFSET a la consulta SQL
$query .= " LIMIT $articulosPorPagina OFFSET $offset";

$result = $conn->query($query);

// Asignar los resultados a la variable $articulos
$articulos = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Virtual</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-HHYOzNUbFp9I6jWZ0ugdWzJybG51cjY/9NnsDOK5M4Fhha/Oj2C0tHckJDdpkM0j+aE8WT6STxSOybn+7zm0XA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bg-golden {
            background-color: #EABE3F;
            /* Código hexadecimal para el color dorado */
            /* O puedes usar otros formatos como RGB o el nombre del color */
        }

        .brand-title {
            font-size: 150px;
            /* Tamaño del título */
            color: orange;
            margin-bottom: 0;
            /* Elimina el margen inferior */
        }

        .logo-img {
            max-width: 50 px;
            /* Ancho máximo del logo */
            height: auto;
            /* Altura ajustada automáticamente para mantener la proporción */

        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            height: 100%;
        }

        .card-body {
            background-color: #f8f9fa;
            /* Color de fondo gris claro */
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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
            margin-left: 120px;


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

        /* Estilos para el botón de cerrar */
        #close-popup,
        #btn-registrar {
            display: block;
            width: 120px;
            /* Ancho del botón */
            margin: 0 auto;
            /* Centrado horizontal */
            padding: 10px 20px;
            margin-top: 10px;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            text-align: center;
            line-height: 40px;
            /* Alinea el texto verticalmente */
        }

        #close-popup,
        #btn-registrar {
            background-color: #0f9d58;
            /* Verde claro */
            border: 2px solid transparent;
        }

        #close-popup:hover,
        #btn-registrar:hover {
            background-color: #1285a3;
            /* Celeste */
        }

        /* Estilos específicos para el botón de registrar */
        #btn-registrar {
            background-color: #1285a3;
            /* Celeste por defecto */
            border: 2px solid transparent;
        }

        #btn-registrar:hover {
            background-color: #0f9d58;
            /* Verde claro al pasar el cursor */
            border-color: #1285a3;
            /* Borde azul al pasar el cursor */
        }

        /* Estilos para el popup del carrito */
        .cart-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            /* Fondo transparente gris */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* Asegura que esté por encima del contenido */
            border: 2px solid #ff0000;
            /* Borde rojo de 2px */
            text-align: center;
            /* Texto centrado */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener referencias al enlace del carrito y al popup
            var cartLink = document.getElementById("cart-link");
            var cartPopup = document.getElementById("cart-popup");
            var closeButton = document.getElementById("close-popup");
            var timer; // Variable para almacenar el ID del temporizador

            // Función para mostrar el popup del carrito
            function mostrarPopup() {
                cartPopup.style.display = "block"; // Mostrar el popup del carrito
            }

            // Función para ocultar el popup del carrito
            function ocultarPopup() {
                cartPopup.style.display = "none"; // Ocultar el popup del carrito
                // Detener el temporizador si está activo
                if (timer) {
                    clearTimeout(timer);
                }
            }

            // Agregar evento de clic al botón de cerrar
            closeButton.addEventListener("click", function(event) {
                // Ocultar el popup del carrito
                ocultarPopup();
            });

            // Agregar evento de clic al enlace del carrito
            cartLink.addEventListener("click", function(event) {
                // Verificar si hay una sesión iniciada utilizando AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'chequearsesion.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        if (response === 'conectar') {
                            // Si hay una sesión iniciada, redirigir a carrito.php
                            window.location.href = 'carrito.php';
                        } else {
                            // Si no hay una sesión iniciada, redirigir a la página de registro
                            window.location.href = 'registrar.php';
                        }
                    }
                };
                xhr.send();
            });

            // Agregar evento de mouseenter al icono del carrito
            cartLink.addEventListener("mouseenter", function(event) {
                // Verificar si hay una sesión iniciada utilizando AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'chequearsesion.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        if (response === 'desconectado') {
                            // Si no hay una sesión iniciada, mostrar el popup del carrito
                            mostrarPopup();
                        }
                    }
                };
                xhr.send();
            });

            // Agregar evento de mouseleave al icono del carrito
            cartLink.addEventListener("mouseleave", function(event) {
                // Ocultar el popup del carrito
                ocultarPopup();
            });

            // Evitar que se oculte el popup del carrito al hacer clic dentro de él
            cartPopup.addEventListener("click", function(event) {
                event.stopPropagation();
            });

            // Ocultar el popup del carrito al hacer clic fuera de él
            document.addEventListener("click", function(event) {
                if (event.target != cartLink) {
                    ocultarPopup();
                }
            });
        });
    </script>







    <!-- JavaScript para mostrar el mensaje emergente al hacer clic en el icono del carrito -->


</head>

<body>

    <header class="container-fluid py-3">
        <div class="row align-items-center">
            <div class="col-xs-1 col-md-1 col-sm-12">
                <div class="logo-container">
                    <img src="img/logo/zapatilla_logo.png" alt="logo Zapatillalandia" class="img-fluid">
                </div>
            </div>
            <div class="col-md-8 text-center">
                <h1 class="brand-title">Zapatillalandia</h1>
            </div>
            <div class="col-md-3">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">INICIO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">QUIÉNES SOMOS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">PROMOCIONES</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">ENVÍO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">DEVOLUCIONES</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">CONTACTO</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>





                <div class="row justify-content-end">
                    <div class="col-xs-12 col-sm-6 col-md-10">
                        <form name="buscar" method="GET" action="index.php">
                            <div class="input-group">
                                <input type="text" name="buscar" class="form-control form-control-sm fw-light" placeholder="Buscar productos" value="">
                                <div class="input-group-btn input-group-sm">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <br>
        </div>
        </div>
        </div>


        <div class="row text-center mb-2" style="background-color:#EABE3F; height: 3px; margin-top: 20px;">
        </div>
        </div>
    </header>
    </section>

    <section id="seccion2" class="container-fluid">
        <div class="row">
            <!-- Menú Aside de Categorías y Subcategorías -->
            <div class="col-md-3 order-md-1" style="border-right:1px solid #ccc;">
                <aside>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <?php
                        // Incluir el archivo de conexión a la base de datos
                        include_once 'conexion.php';

                        // Crear una instancia de la clase Database
                        $database = new Database();
                        $conexion = $database->getConnection();

                        // Obtener todas las categorías principales
                        $query_categorias = "SELECT * FROM categoria WHERE activo = 1 ";
                        $result_categorias = $conexion->query($query_categorias);

                        // Comprobar si hay categorías principales
                        if ($result_categorias->rowCount() > 0) {
                            // Iterar sobre cada categoría principal
                            while ($categoria = $result_categorias->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="accordion-item">';
                                echo '<h3 class="accordion-header" id="flush-heading' . $categoria['codigo'] . '">';
                                echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' . $categoria['codigo'] . '" aria-expanded="false" aria-controls="flush-collapse' . $categoria['codigo'] . '">';
                                echo $categoria['nombre'];
                                echo '</button>';
                                echo '</h3>';
                                echo '<div id="flush-collapse' . $categoria['codigo'] . '" class="accordion-collapse collapse" aria-labelledby="flush-heading' . $categoria['codigo'] . '" data-bs-parent="#accordionFlushExample">';
                                echo '<div class="accordion-body">';
                                echo '<ul class="list-group list-group-light">';

                                // Obtener todas las subcategorías de la categoría principal actual
                                $query_subcategorias = "SELECT * FROM subcategoria WHERE codCategoriaPadre = " . $categoria['codigo'];
                                $result_subcategorias = $conexion->query($query_subcategorias);

                                // Comprobar si hay subcategorías
                                if ($result_subcategorias->rowCount() > 0) {
                                    // Iterar sobre cada subcategoría
                                    while ($subcategoria = $result_subcategorias->fetch(PDO::FETCH_ASSOC)) {
                                        // Construir la URL con los parámetros de categoría y subcategoría
                                        $url = 'index.php?categoria=' . $categoria['codigo'] . '&subcategoria=' . $subcategoria['codigo'];
                                        // Imprimir el enlace con la URL construida
                                        echo '<a href="' . $url . '" class="list-group-item list-group-item-action px-3 border-0">' . $subcategoria['nombre'] . '</a>';
                                    }
                                }
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo 'No hay categorías disponibles.';
                        }

                        // Cerrar la conexión a la base de datos
                        $conexion = null;
                        ?>
                    </div>
                </aside>
            </div>

            <!-- Sección de visualización de Artículos -->
            <div class="col-md-6 order-md-2" style="text-align:center;">
                <!-- Mostrar los artículos -->
                <div class="row">
                    <div>

                        <?php
                        if (!isset($_GET['categoria']) && !isset($_GET['subcategoria'])) {
                            // Incluir el archivo de conexión a la base de datos
                            include_once 'conexion.php';

                            // Crear una instancia de la clase Database
                            $database = new Database();

                            // Obtener la conexión
                            $conn = $database->getConnection();

                            // Consulta SQL para obtener todos los artículos
                            $query = "SELECT * FROM articulos";

                            // Preparar la consulta
                            $stmt = $conn->prepare($query);

                            // Ejecutar la consulta
                            $stmt->execute();

                            // Obtener los resultados
                            $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Mostrar las tarjetas de los artículos
                            // Si hay artículos, mostrar solo el primero
                            if (!empty($articulos)) {
                                $articulo = $articulos[0];
                                include 'tarjeta.php'; // Muestra la tarjeta del artículo
                            }
                        }
                        ?>
                    </div> <!-- Cierre de row -->


                    <?php
                    // Incluir el archivo de conexión a la base de datos
                    include_once 'conexion.php';

                    // Crear una instancia de la clase Database
                    $database = new Database();

                    // Obtener la conexión
                    $conn = $database->getConnection();

                    // Obtener el valor de la categoría y subcategoría de la URL
                    $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
                    $subcategoriaSeleccionada = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : null;

                    // Definir el número de artículos por página
                    $articulosPorPagina = 2; // Puedes ajustar este valor según tus necesidades

                    // Calcular el índice de inicio para la consulta según la página actual
                    $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
                    $indiceInicio = ($paginaActual - 1) * $articulosPorPagina;

                    // Consulta SQL para obtener los artículos filtrados por categoría y subcategoría
                    $query = "SELECT * FROM articulos WHERE categoria = :categoria AND subcategoria = :subcategoria LIMIT $indiceInicio, $articulosPorPagina";

                    // Preparar la consulta
                    $stmt = $conn->prepare($query);

                    // Asignar valores a los parámetros de la consulta
                    $stmt->bindParam(':categoria', $categoriaSeleccionada);
                    $stmt->bindParam(':subcategoria', $subcategoriaSeleccionada);

                    // Ejecutar la consulta
                    $stmt->execute();

                    // Obtener los resultados
                    $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Ahora puedes mostrar los artículos filtrados en tu página
                    foreach ($articulos as $articulo) : ?>
                        <?php
                        // Verificar si el artículo pertenece a la categoría y subcategoría seleccionadas
                        if (($categoriaSeleccionada === 'todos' || $articulo['categoria'] == $categoriaSeleccionada) &&
                            ($subcategoriaSeleccionada === 'todos' || $articulo['subcategoria'] == $subcategoriaSeleccionada)
                        ) { ?>
                            <?php {
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
                                        <p class="card-text"><?php echo "Precio: €" . $articulo['precio']; ?></p>
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
                        <?php } ?> <!-- Cierre de if -->
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

            // Obtener el valor de la categoría y subcategoría de la URL
            $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
            $subcategoriaSeleccionada = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : null;

            // Definir el número de artículos por página
            $articulosPorPagina = 2; // Puedes ajustar este valor según tus necesidades

            // Consulta SQL para obtener los artículos filtrados por categoría y subcategoría
            $query = "SELECT COUNT(*) as total FROM articulos WHERE categoria = :categoria AND subcategoria = :subcategoria";

            // Preparar la consulta
            $stmt = $conn->prepare($query);

            // Asignar valores a los parámetros de la consulta
            $stmt->bindParam(':categoria', $categoriaSeleccionada);
            $stmt->bindParam(':subcategoria', $subcategoriaSeleccionada);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el total de artículos
            $totalArticulos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Calcular la cantidad total de páginas necesarias
            $totalPaginas = ceil($totalArticulos / $articulosPorPagina);

            // Obtener la página actual
            $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calcular el índice de inicio para la consulta según la página actual
            $indiceInicio = ($paginaActual - 1) * $articulosPorPagina;

            // Consulta SQL para obtener los artículos limitados por página
            $query = "SELECT * FROM articulos WHERE categoria = :categoria AND subcategoria = :subcategoria LIMIT :inicio, :limite";

            // Preparar la consulta
            $stmt = $conn->prepare($query);

            // Asignar valores a los parámetros de la consulta
            $stmt->bindParam(':categoria', $categoriaSeleccionada);
            $stmt->bindParam(':subcategoria', $subcategoriaSeleccionada);
            $stmt->bindParam(':inicio', $indiceInicio, PDO::PARAM_INT);
            $stmt->bindParam(':limite', $articulosPorPagina, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar solo los enlaces a páginas si hay más de una página
            if ($totalPaginas > 0) {
                echo '<nav aria-label="Page navigation example">';
                echo '<ul class="pagination justify-content-center mt-4">';

                // Botón "Anterior"
                if ($paginaActual > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($paginaActual - 1) . '&categoria=' . $categoriaSeleccionada . '&subcategoria=' . $subcategoriaSeleccionada . '">Anterior</a></li>';
                }

                // Enlaces a las páginas
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo '<li class="page-item ' . ($i == $paginaActual ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&categoria=' . $categoriaSeleccionada . '&subcategoria=' . $subcategoriaSeleccionada . '">' . $i . '</a></li>';
                }

                // Botón "Siguiente"
                if ($paginaActual < $totalPaginas) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($paginaActual + 1) . '&categoria=' . $categoriaSeleccionada . '&subcategoria=' . $subcategoriaSeleccionada . '">Siguiente</a></li>';
                }

                echo '</ul>';
                echo '</nav>';
            }

            // Ahora puedes mostrar los artículos filtrados en tu página
            foreach ($articulos as $articulo) {
                // Tu código para mostrar cada artículo aquí
            }
            ?>




            <div class="col-md-3 order-md-3 text-center text-center ms-auto" style="border-left:1px solid #ccc; text-align:center ;margin-left: 300px;">

                <aside>
                    <?php
                    function obtenerCantidadArticulosCarrito()
                    {
                        // Simulación: devolver un número aleatorio entre 0 y 10
                        return 0;
                    }
                    $cantidad_articulos = obtenerCantidadArticulosCarrito(); // Debes implementar esta función

                    // Verificar si hay una sesión iniciada
                    if (isset($_SESSION['nombre_usuario'])) {
                        // Si hay una sesión iniciada, mostrar el mensaje de bienvenida y el botón de logout
                        echo "<div class='container'>";
                        echo "<p class='fw-bold'>Bienvenido, " . $_SESSION['nombre_usuario'] . "</p>";
                        echo "<form action='logout.php' method='post'>";
                        echo "<p><a href='paneldeadministrador.php' style='text-decoration: none; color: inherit;'><i class='fas fa-cogs'></i> Panel de control</a></p>" . "<br>";
                        echo "<button type='submit' class='btn btn-primary bg-golden border-0'>Cerrar sesión</button>";
                        echo "</form>";

                        // Obtener la cantidad de artículos en el carrito
                        if (isset($_SESSION['dni_usuario']) && isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                            // Inicializar la cantidad total de artículos en el carrito
                            $cantidad_articulos = 0;

                            // Iterar sobre cada elemento del carrito
                            foreach ($_SESSION['carrito'] as $linea_pedido) {
                                // Sumar la cantidad de cada artículo al total
                                $cantidad_articulos += $linea_pedido['cantidad'];
                            }

                            // Mostrar la cantidad total de artículos en el carrito
                            echo "<br><br><br><br><span class='cart-count' style='font-size: 30px;'>Cantidad total de artículos en el carrito: ";

                            // Mostrar el icono del carrito y la cantidad de artículos
                            echo "<div class='cart-info'>";
                            echo "<a id='cart-link' href='carrito.php'><i id='cart-icon' class='fas fa-shopping-cart fa-2x'></i></a>";

                            echo "<span class='cart-count' style='font-size: 30px;'><strong>$cantidad_articulos unidades</strong></span>";
                            echo "</div>";

                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "El usuario no ha iniciado sesión o el carrito está vacío.";
                        }

                        // Mostrar el icono del carrito y la cantidad de artículos
                        echo "<div class='cart-info'>";

                        echo "</div>";
                    } else {
                        // Si no hay una sesión iniciada, mostrar el formulario de inicio de sesión
                        echo "<div class='container'>";
                        echo "<div class='mt-2'>";
                        echo "<p class='fw-bold'>INICIA SESIÓN</p>";
                        echo "<form action='login.php' method='post'>"; // Cambiar 'conexion.php' por 'login.php'
                        echo "<div class='table-responsive'>";
                        echo "<table align='center' class='table table-borderless'>";
                        echo "<tr>";
                        echo "<td colspan='2'>";
                        echo "<span>Nombre:</span><br />";
                        echo "<input type='text' name='user'>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='2'>";
                        echo "<span>Contraseña:</span><br />";
                        echo "<input type='password' name='key'>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='2'>";


                        if (isset($_SESSION['error_msg'])) {
                            echo "<span style='color: blue; font-size: smaller;'>" . $_SESSION['error_msg'] . "</span>";
                            unset($_SESSION['error_msg']);
                        }

                        echo "</td>";
                        echo " </tr>";
                        echo "<tr>";
                        echo "<td align='right'> <input type='submit' class='btn btn-primary bg-golden border-0' value='Enviar'> </td>";
                        echo "<td align='left'> <input type='reset' class='btn btn-primary bg-golden border-0' value='Borrar'> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='2'><a class='small text-dark' href='cambiarclave.php'>¿Has olvidado tu contraseña?</a></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "<table align='center' width='100%' class='table table-borderless'>";
                        echo "<tr>";
                        echo "<td class='fw-bold text-center'><a class='cuenta text-decoration-none text-dark' href='registrar.php'>Regístrate</a></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                        echo "<div class='cart-info'>";
                        echo "<a id='cart-link' href='carrito.php'><i id='cart-icon' class='fas fa-shopping-cart fa-2x' style='color: #ccc;'></i></a></br>";
                        echo "<span class='cart-count'>$cantidad_articulos unidades</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </aside>

                <div id='cart-popup' class='cart-popup'>
                    <p><strong>Regístrate para comprar</strong></p>

                    <button id="btn-registrar"><a href='registrar.php' style="text-decoration: none; color: inherit;">Registrarse</a></button>
                    <button id="close-popup">Cerrar</button>
                </div>





            </div>


    </section>
    </div>
    <section class="container-fluid">
        <div class="row">
            <footer class="panel-footer bg-golden text-white">
                <div class="col-xs-12 col-0">
                    <img src="img/logo/zapatilla_logo2.png" alt="Zpatilandia" width="80">
                </div>
                <div class="col-xs-12 col-24 text-center">
                    <h5>Información</h5>
                    <ul class="list-unstyled mb-0">
                        <li>Atención al cliente</li>
                        <li>Pagos</li>
                        <li>Políticas de Devoluciones</li>
                        <li>Contacto</li>
                        <li>Sobre Nosotros</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-28S text-end">
                    <a href="#"><i class="fab fa-facebook text-white me-2"></i></a>
                    <a href="#"><i class="fab fa-twitter text-white me-2"></i></a>
                    <a href="#"><i class="fab fa-instagram text-white me-2"></i></a>
                </div>
            </footer>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <footer class="panel-footer bg-golden text-white text-center">
                <p class="mb-0">Copyright&copy; 2024 Zapatilandia</p>
            </footer>
        </div>
    </section>


</body>

</html>