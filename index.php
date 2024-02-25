<?php


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

        .card-descuento {
         
        background-color: #ff0000; /* Fondo rojo */
        color: #ffffff; /* Texto blanco */
        padding: 5px; /* Espaciado interno */
        border-radius: 5px; /* Bordes redondeados */
        margin-bottom: 20px; /* Espacio inferior */
        width: fit-content; /* Ancho ajustado al contenido */
        text-align: center; /* Centrado horizontal */
       
   
    
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
    </style>
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
                                    <a class="nav-link" href="#">INICIO</a>
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
            <div class="col-xs-6 col-sm-2 col-md-2" style="border-right:1px solid #ccc;">
                <aside>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                    Zapatos Hombre
                                </button>
                            </h3>
                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1">
                                <div class="accordion-body">
                                    <ul class='list-group list-group-light'>
                                        <a href='index.php?categoria=12' class='list-group-item list-group-item-action px-3 border-0'>Todos</a>
                                        <a href='index.php?categoria=12&subcategoria=3' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='index.php?categoria=12&subcategoria=2' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='index.php?categoria=12&subcategoria=4' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='index.php?categoria=12&subcategoria=5' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                    Zapatos Mujer
                                </button>
                            </h3>
                            <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2">
                                <div class="accordion-body">
                                    <ul class='list-group list-group-light'>
                                        <a href='index.php?categoria=4' class='list-group-item list-group-item-action px-3 border-0'>Todos</a>
                                        <a href='index.php?categoria=4&subcategoria=6' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='index.php?categoria=4&subcategoria=7' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='index.php?categoria=4&subcategoria=8' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='index.php?categoria=4&subcategoria=9' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                                    Zapatos Niños
                                </button>
                            </h3>
                            <div id="flush-collapse3" class="accordion-collapse collapse" aria-labelledby="flush-heading3">
                                <div class="accordion-body">
                                    <ul class='list-group list-group-light'>
                                        <a href='index.php?categoria=13' class='list-group-item list-group-item-action px-3 border-0'>Todos</a>
                                        <a href='index.php?categoria=13&subcategoria=10' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='index.php?categoria=13&subcategoria=11' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='index.php?categoria=13&subcategoria=12' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='index.php?categoria=13&subcategoria=13' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="flush-heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                                    Running
                                </button>
                            </h3>
                            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4">
                                <div class="accordion-body">
                                    <ul class='list-group list-group-light'>
                                        <a href='index.php?categoria=17' class='list-group-item list-group-item-action px-3 border-0'>Especiales del Deporte</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6" style="text-align:center;">
                <?php
                include_once 'conexion.php'; // Incluir el archivo que contiene la clase Database

                // Crear una instancia de la clase Database
                $database = new Database();

                // Obtener la conexión PDO
                $conn = $database->getConnection();

                // Verificar la conexión
                if ($conn) {
                    // Consulta SQL para obtener todos los artículos
                    $query = "SELECT * FROM articulos";

                    // Preparar la consulta
                    $stmt = $conn->prepare($query);

                    // Ejecutar la consulta
                    $stmt->execute();

                    // Obtener los resultados
                    $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    echo "Error al establecer la conexión.";
                }
                ?>

                <!-- Mostrar los artículos -->

                <div class="row">

                    <?php foreach ($articulos as $articulo) : ?>
                        <?php
                        // Verificar si el artículo pertenece a la categoría y subcategoría seleccionadas
                        if (($categoriaSeleccionada === 'todos' || $articulo['categoria'] == $categoriaSeleccionada) &&
                            ($subcategoriaSeleccionada === 'todos' || $articulo['subcategoria'] == $subcategoriaSeleccionada)
                        ) {
                        ?>
                            <div class="col-sm-4 mb-4">
                                <div class="card">
                                    <!-- Generar la URL completa de la imagen -->
                                    <?php
                                    // Obtener la categoría y subcategoría del artículo
                                    $categoria = $articulo['categoria'];
                                    $subcategoria = $articulo['subcategoria'];
                                    // Definir la ruta base según la categoría y subcategoría
                                    $ruta_base = "";
                                    if ($categoria == 12 && $subcategoria == 3) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Clásico"
                                        $ruta_base = "img/Zapatillas hombre/Clasicas/";
                                    } elseif ($categoria == 12 && $subcategoria == 2) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Novedades"
                                        $ruta_base = "img/Zapatillas hombre/Novedades/";
                                    } elseif ($categoria == 12 && $subcategoria == 4) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Deportivas"
                                        $ruta_base = "img/Zapatillas hombre/Deportivas/";
                                    } elseif ($categoria == 12 && $subcategoria == 5) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas hombre/Outlet/";
                                    } elseif ($categoria == 4 && $subcategoria == 8) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas mujer/Deportivas/";
                                    } elseif ($categoria == 4 && $subcategoria == 6) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas mujer/Novedades/";
                                    } elseif ($categoria == 4 && $subcategoria == 7) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas mujer/Clasicas/";
                                    } elseif ($categoria == 4 && $subcategoria == 9) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas mujer/Outlet/";
                                    } elseif ($categoria == 13 && $subcategoria == 10) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas Niños/Novedades/";
                                    } elseif ($categoria == 13 && $subcategoria == 11) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas Niños/Clasicas/";
                                    } elseif ($categoria == 13 && $subcategoria == 12) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas Niños/Deportivas/";
                                    } elseif ($categoria == 13 && $subcategoria == 13) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/Zapatillas Niños/Outlet/";
                                    } elseif ($categoria == 17 && $subcategoria == 18) {
                                        // Ruta para la categoría "Zapatillas hombre" y subcategoría "Outlet"
                                        $ruta_base = "img/running/especiales del deporte/";
                                    }
                                    // Concatenar el nombre de la imagen a la ruta base
                                    $ruta_imagen = $ruta_base . $articulo['imagen'];
                                    ?>
                                    <img src="<?php echo $ruta_imagen; ?>" class="card-img-top" alt="<?php echo $articulo['nombre']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $articulo['nombre']; ?></h5>
                                        <p class="card-text"><?php echo $articulo['descripcion']; ?></p>
                                        <p class="card-text"><?php echo "Precio: $" . $articulo['precio']; ?></p>
                                        <?php if ($articulo['descuento'] > 0) : ?>
                                            <p class="card-discount"><?php echo "Descuento: %" . $articulo['descuento']; ?></p>
                                        <?php endif; ?>
                                        <form action="carrito.php" method="post">
                                            <input type="hidden" name="articulo_id" value="<?php echo $articulo['codigo']; ?>">
                                            <input type="hidden" name="precio" value="<?php echo $articulo['precio']; ?>">
                                            <input type="hidden" name="descuento" value="<?php echo $articulo['descuento']; ?>">
                                            <input type="hidden" name="cod_usuario" value="<?php echo $dni_usuario; ?>">
                                            <input type="hidden" name="cantidad" value="1">
                                            <button type="submit" name="agregar_al_carrito" class="btn btn-primary">Agregar al carrito</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    <?php endforeach; ?>



                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-4">
                        <?php if ($paginaActual > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $paginaActual - 1; ?>&categoria=<?php echo $categoriaSeleccionada; ?>&subcategoria=<?php echo $subcategoriaSeleccionada; ?>">Anterior</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                            <li class="page-item <?php if ($i == $paginaActual) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&categoria=<?php echo $categoriaSeleccionada; ?>&subcategoria=<?php echo $subcategoriaSeleccionada; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $paginaActual + 1; ?>&categoria=<?php echo $categoriaSeleccionada; ?>&subcategoria=<?php echo $subcategoriaSeleccionada; ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
            <div class="col-xs-10 col-sm-1 col-md-2" style="border-left:1px solid #ccc; text-align:center ;margin-left: 300px;">

                <aside>
                    <?php
                    // Verificar si hay una sesión iniciada
                    if (isset($_SESSION['nombre_usuario'])) {
                        // Si hay una sesión iniciada, mostrar el mensaje de bienvenida y el botón de logout
                        echo "<div class='container'>";
                        echo "<p class='fw-bold'>Bienvenido, " . $_SESSION['nombre_usuario'] . "</p>";
                        echo "<form action='logout.php' method='post'>";
                        echo "<p><a href='paneldeadministrador.php' style='text-decoration: none; color: inherit;'><i class='fas fa-cogs'></i> Panel de control</a></p>" . "<br>";
                        echo "<button type='submit' class='btn btn-primary bg-golden border-0'>Cerrar sesión</button>";
                        echo "</form>";
                        echo "</div>";
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
                        echo "<td align='right'> <input type='submit' class='btn btn-primary bg-golden border-0' value='Enviar'> </td>";
                        echo "<td align='left'> <input type='reset' class='btn btn-primary bg-golden border-0' value='Borrar'> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='2'><a class='small text-dark' href='resetPassword.php'>¿Has olvidado tu contraseña?</a></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "<table align='center' width='100%' class='table table-borderless'>";
                        echo "<tr>";
                        echo "<td class='fw-bold text-center'><a class='cuenta text-decoration-none text-dark' href='registrar.php'>Regístrate</a></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                        echo "</div>";
                    }
                    ?>

                </aside>


            </div>
    </section>

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