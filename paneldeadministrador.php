<?php
require_once 'funciones.php';
verificarRol(1);
require_once 'conexion.php'; // Incluir el archivo de conexión
require 'mostrar_imagenes.php';
session_start();
// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión
$conn = $database->getConnection();

// Verificar si la conexión se estableció correctamente
if (!$conn) {
    echo "Error al conectar a la base de datos";
    exit(); // Salir del script si hay un error en la conexión
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-HHYOzNUbFp9I6jWZ0ugdWzJybG51cjY/9NnsDOK5M4Fhha/Oj2C0tHckJDdpkM0j+aE8WT6STxSOybn+7zm0XA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
        .bg-golden {
            background-color: #EABE3F;
            /* Código hexadecimal para el color dorado */
            /* O puedes usar otros formatos como RGB o el nombre del color */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para el formulario de modificación de artículo */
        #modificacion_articulo {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
        }

        /* Estilos para los títulos de las secciones */
        section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilos para las etiquetas del formulario */
        section label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .styled-button {
            background-color: #45A049;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .styled-button:hover {
            background-color: #0056b3;
        }


        /* Estilos para los campos de entrada del formulario */
        section input[type="text"],
        section input[type="number"],
        section textarea,
        section select {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para los botones del formulario */
        section input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        section input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para el formulario "Crear Nuevo Usuario" */
        .crear-usuario-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 0 auto;
            /* Centra el formulario horizontalmente */
        }

       
        /* Estilos para las etiquetas del formulario */
        .crear-usuario-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Estilos para los campos de entrada del formulario */
        .crear-usuario-form input[type="text"],
        .crear-usuario-form input[type="email"],
        .crear-usuario-form input[type="password"],
        .crear-usuario-form select {
            width: 100%;
            /* Ahora ocupará el 100% del contenedor */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para los botones del formulario */
        .crear-usuario-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .crear-usuario-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para los formularios de alta, baja, modificación y búsqueda de categorías */
        #alta_categoria,
        #baja_categoria,
        #modificacion_categoria,
        #busqueda_categoria {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
        }

        /* Estilos para los títulos de las secciones */
        section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilos para las etiquetas del formulario */
        section label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Estilos para los campos de entrada del formulario */
        section input[type="text"],
        section input[type="number"],
        section select {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para los botones del formulario */
        section input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        section input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para los formularios de alta, baja, modificación y búsqueda de subcategorías */
        #alta_subcategoria,
        #baja_subcategoria,
        #modificacion_subcategoria,
        #busqueda_subcategoria {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
        }

        /* Estilos para los títulos de las secciones */
        section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilos para las etiquetas del formulario */
        section label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Estilos para los campos de entrada del formulario */
        section input[type="text"],
        section input[type="number"],
        section select {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para los botones del formulario */
        section input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        section input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para la sección de alta de artículo */
        #alta_articulo {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
        }

        /* Estilos para los títulos de las secciones */
        section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilos para las etiquetas del formulario */
        section label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Estilos para los campos de entrada del formulario */
        section input[type="text"],
        section input[type="number"],
        section textarea,
        section select {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para los botones del formulario */
        section input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        section input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para la sección de búsqueda, modificación y eliminación de artículo */
        #baja_modificacion_articulo {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
        }

        /* Estilos para los formularios de búsqueda, modificación y eliminación de artículo */
        #baja_modificacion_articulo form {
            margin-bottom: 20px;
        }

        /* Estilos para el formulario de búsqueda de artículo */
        #baja_modificacion_articulo form:first-child {
            margin-top: 0;
        }

        /* Estilos para el formulario de modificación y eliminación de artículo */
        #baja_modificacion_articulo form:last-child {
            margin-bottom: 0;
        }

        /* Estilos para el formulario de búsqueda de artículo */
        #busqueda_articulo form {
            max-width: 400px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        #busqueda_articulo label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        #busqueda_articulo input[type="text"] {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #busqueda_articulo input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #busqueda_articulo input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para el formulario de cambio de rol de usuario */
        .cambioderol {
            max-width: 400px;
            /* Ajusta el tamaño máximo del formulario */
            margin: 20px auto;
            /* Centra el formulario horizontalmente */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .cambioderol label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .cambioderol select {
            width: calc(100% - 20px);
            /* El ancho del campo se ajusta al 100% menos el padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .cambioderol input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .cambioderol input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categoria').change(function() {
                var categoriaSeleccionada = $(this).val();
                if (categoriaSeleccionada != '') {
                    $.ajax({
                        type: "POST",
                        url: "obtener_subcategoria.php",
                        data: {
                            categoria: categoriaSeleccionada
                        },
                        success: function(data) {
                            $('#subcategoria').html(data);
                        }
                    });
                } else {
                    $('#subcategoria').html('<option value="">Selecciona una categoría primero</option>');
                }
            });
        });
    </script>

</head>

<body>


    <section id="header" class="container-fluid ">
        <div class="col-xs-12 col-sm-4 col-md-4 ">
            <div id="logos">
                <div class="pull-left">
                    <img class="d-block img-fluid" src="img/logo/zapatilla_logo.png" width="20%" alt="logo Zapatilla">
                    <!-- Modificado el width -->
                </div>
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="row mt-8">
                <div class="row justify-content-end align-items-start">
                    <nav class="navbar navbar-default navbar-expand-lg navbar-light bg-transparent rounded" style="background-color:green" ; aria-label="Twelfth navbar example">
                        <div class="container-fluid">
                            <a class="navbar-header"></a>
                            <button id="navbar-toggler-button" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse  justify-content-md-end" id="navbarsExample10">
                                <ul class="navbar-nav ms-auto"> <!-- Alineado a la derecha -->
                                    <li class="nav-item">
                                        <a class='nav-link active' aria-current='page' href='index.php'>INICIO</a> <!-- Cambiado "HOME" por "INICIO" -->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">QUIÉNES SOMOS</a> <!-- "QUIENES SOMOS" cambiado por "QUIÉNES SOMOS" -->
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
                </div>

                <div class="row justify-content-end">
                    <div class="col-xs-12 col-sm-4 col-md-3">
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


        <div class="row text-center mb-2" style="background-color:#EABE3F; height: 3px;">
        </div>
        </div>
    </section>

    <section id="seccion2" class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="border-right:1px solid #ccc;">
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
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
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
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
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
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Novedades</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Clásico</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Deportivos</a>
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Outlet</a>
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
                                        <a href='#' class='list-group-item list-group-item-action px-3 border-0'>Especiales del Deporte</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-8" style="text-align:center;">

                <h1>Panel de Administrador</h1>



                <!-- Mostrar todos los usuarios -->
                <h3>Usuarios Registrados</h3>
                <?php
                // Incluir el archivo de conexión a la base de datos
                require_once 'conexion.php';

                // Crear una instancia de la clase Database
                $database = new Database();

                // Obtener la conexión
                $conn = $database->getConnection();

                // Verificar si la conexión se estableció correctamente
                if (!$conn) {
                    echo "Error al conectar a la base de datos";
                    exit(); // Salir del script si hay un error en la conexión
                }

                // Consultar todos los usuarios
                $stmt = $conn->prepare("SELECT * FROM usuarios");
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <h2>Lista de Usuarios</h2>
                <table>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Localidad</th>
                            <th>Provincia</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['dni']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['apellido']; ?></td>
                                <td><?php echo $usuario['direccion']; ?></td>
                                <td><?php echo $usuario['localidad']; ?></td>
                                <td><?php echo $usuario['provincia']; ?></td>
                                <td><?php echo $usuario['telefono']; ?></td>
                                <td><?php echo $usuario['email']; ?></td>
                                <td><?php echo $usuario['rol']; ?></td>
                                <td><?php echo $usuario['activo'] == 1 ? 'Sí' : 'No'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>



            <div class="col-md-2" style="border-left:1px solid #ccc; text-align:center ;">
                <aside>
                    <?php
                    // Verificar si hay una sesión iniciada
                    if (isset($_SESSION['nombre_usuario'])) {
                        // Si hay una sesión iniciada, mostrar el mensaje de bienvenida y el botón de logout
                        echo "<div class='container'>";
                        echo "<p class='fw-bold'>Bienvenido, " . $_SESSION['nombre_usuario'] . "</p>";
                        echo "<p><a href='index.php' style='text-decoration: none; color: inherit;'><i class='fas fa-home'></i> Inicio</a></p>" . "<br>";
                        echo "<form action='logout.php' method='post'>";
                        echo "<button type='submit' class='btn btn-primary bg-golden border-0'>Cerrar sesión</button>";
                        echo "</form>";
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
                        echo "</div>";
                    }
                    ?>

                </aside>


            </div>
        </div></br>
    </section>
    </div>
    <div class="row text-center mb-2" style="background-color:#EABE3F; height: 3px;">
    </div></br></br>
    <section id="seccion3" class="container-fluid">
        <div class="row">



            <?php

            require_once 'conexion.php';

            // Obtener la lista de usuarios
            $usuarios = obtenerUsuarios();

            // Procesar cambio de rol
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_rol'])) {
                $nombre_usuario = $_POST['nombre_usuario'];
                $nuevo_rol_id = $_POST['nuevo_rol'];

                // Consulta SQL para obtener el ID del usuario seleccionado
                $stmt = $conn->prepare("SELECT dni FROM usuarios WHERE dni = :nombre_usuario");
                $stmt->bindParam(':nombre_usuario', $nombre_usuario);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $usuario_id = $row['dni'];

                // Consulta SQL para actualizar el rol del usuario
                $stmt = $conn->prepare("UPDATE usuarios SET rol = :nuevo_rol_id WHERE dni = :usuario_id");
                $stmt->bindParam(':nuevo_rol_id', $nuevo_rol_id, PDO::PARAM_INT);
                $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "Rol de usuario cambiado exitosamente.";
                } else {
                    echo "Error al cambiar el rol de usuario.";
                }
            }

            function obtenerUsuarios()
            {
                global $conn;
                $stmt = $conn->query("SELECT dni, nombre, apellido FROM usuarios");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body" id="modificacion_articulo">

                        <h3>Cambiar Rol de Usuario</h3>
                        <form class="cambioderol" action="" method="post">
                            <label for="nombre_usuario">Seleccione Usuario:</label>
                            <select name="nombre_usuario" required>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <option value="<?php echo $usuario['dni']; ?>"><?php echo $usuario['dni'] . ' - ' . $usuario['nombre'] . ' ' . $usuario['apellido']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="nuevo_rol">Nuevo Rol:</label>
                            <select name="nuevo_rol" required>
                                <option value="1">Administrador</option>
                                <option value="2">Editor</option>
                                <option value="3">Cliente</option>
                            </select>
                            <input type="submit" name="cambiar_rol" value="Cambiar Rol">
                        </form>

                        <?php
                        // Verificar si se debe mostrar el mensaje de alta
                        if (isset($_GET['alta']) && $_GET['alta'] == "true") {
                            echo '<script>window.onload = function() { mostrarMensaje(); }</script>';
                        }
                        ?>

                        <h3>Alta de Usuario</h3>
                        <form action="dardealta.php" method="post">
                            <label for="user">DNI del usuario:</label>
                            <input type="text" id="user" name="user">
                            <button type="submit" name="submit" class="styled-button">Alta de usuario</button>
                        </form>

                        <div id="mensaje" style="display: none;">
                            <p>El usuario ha sido dado de alta correctamente.</p>
                            
                        </div>

                        <script>
                            function mostrarMensaje() {
                                document.getElementById("mensaje").style.display = "block";
                            }

                            function cerrarVentana() {
                                document.getElementById("mensaje").style.display = "none";
                            }
                        </script>





                    </div>

                    <div class="card-body" id="modificacion_articulo">

                        <h2>Eliminar Usuario</h2>
                        <form action="eliminarusuario.php" method="post">
                            <label for="dni_a_eliminar">DNI del usuario a eliminar:</label><br>
                            <input type="text" id="dni_a_eliminar" name="dni_a_eliminar" required><br><br>
                            <input type="submit" name="eliminar_usuario" value="Eliminar Usuario">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body">

                        <!-- Crear Nuevo Usuario -->
                        <h3 class="crear-usuario-titulo">Crear Nuevo Usuario</h3>
                        <form class="crear-usuario-form" action="" method="post">
                            <div class="form-group row">
                                <label for="dni" class="col-sm-4 col-form-label">DNI:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="dni" required><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido" class="col-sm-4 col-form-label">Apellido:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="apellido" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-sm-4 col-form-label">Teléfono:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="telefono" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-sm-4 col-form-label">Dirección:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="direccion" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="localidad" class="col-sm-4 col-form-label">Localidad:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="localidad" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="provincia" class="col-sm-4 col-form-label">Provincia:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="provincia" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="clave" class="col-sm-4 col-form-label">Contraseña:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="clave" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[.-@])[A-Za-z.-@]{10,}" title="La contraseña debe contener al menos una mayúscula, una minúscula, un símbolo (. - @) y tener al menos 10 caracteres." required><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rol" class="col-sm-4 col-form-label">Rol:</label>
                                <div class="col-sm-8">
                                    <select name="rol" class="form-control" required>
                                        <option value="1">Administrador</option>
                                        <option value="2">Editor</option>
                                        <option value="3">Cliente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="activo" class="col-sm-4 col-form-label">Activo:</label>
                                <div class="col-sm-8">
                                    <select name="activo" class="form-control" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="submit" name="crear_usuario" value="Crear Usuario" class="btn btn-primary">
                                </div>
                            </div>
                        </form>


                        <?php
                        require_once 'conexion.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_usuario'])) {
                            // Validar los campos del formulario
                            $dni = validarCampo($_POST['dni'], '/^[0-9]{8}[A-Za-z]$/', 'DNI');
                            $nombre = validarCampo($_POST['nombre'], null, 'Nombre');
                            $apellido = validarCampo($_POST['apellido'], null, 'Apellido');
                            $telefono = validarCampo($_POST['telefono'], '/^[0-9]{9}$/', 'Teléfono');
                            $direccion = validarCampo($_POST['direccion'], null, 'Dirección');
                            $localidad = validarCampo($_POST['localidad'], null, 'Localidad');
                            $provincia = validarCampo($_POST['provincia'], null, 'Provincia');
                            $email = validarCampo($_POST['email'], null, 'Email');
                            $clave = $_POST['clave']; // Contraseña sin hashear
                            $rol = $_POST['rol'];
                            $activo = $_POST['activo'];

                            // Verificar que la contraseña cumple con los requisitos
                            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[.-@])[A-Za-z.-@]{10,}$/', $clave)) {
                                echo "La contraseña debe contener al menos una mayúscula, una minúscula, un símbolo (. - @) y tener al menos 10 caracteres.";
                                exit;
                            }

                            $clave_hash = password_hash($clave, PASSWORD_DEFAULT); // Generar hash de la contraseña


                            $stmt = $conn->prepare("SELECT dni FROM usuarios WHERE dni = ?");
                            $stmt->execute([$dni]);
                            if ($stmt->rowCount() > 0) {
                                echo "El DNI ya está registrado.";
                                exit;
                            }
                            // Insertar nuevo usuario
                            $conexion = new Database();
                            $conn = $conexion->getConnection();
                            $stmt = $conn->prepare("INSERT INTO usuarios (dni, nombre, apellido, telefono, direccion, localidad, provincia, email, clave, clave_hash, rol, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bindParam(1, $dni);
                            $stmt->bindParam(2, $nombre);
                            $stmt->bindParam(3, $apellido);
                            $stmt->bindParam(4, $telefono);
                            $stmt->bindParam(5, $direccion);
                            $stmt->bindParam(6, $localidad);
                            $stmt->bindParam(7, $provincia);
                            $stmt->bindParam(8, $email);
                            $stmt->bindParam(9, $clave); // Almacenar la contraseña sin hashear
                            $stmt->bindParam(10, $clave_hash); // Almacenar el hash de la contraseña
                            $stmt->bindParam(11, $rol);
                            $stmt->bindParam(12, $activo);

                            if ($stmt->execute()) {
                                echo "Registro exitoso. Ahora puedes iniciar sesión.";
                            } else {
                                echo "Error al registrarse.";
                            }
                        }

                        function validarCampo($campo, $filtro = null, $nombreCampo = null)
                        {
                            $campo = trim($campo);
                            if ($filtro !== null && !preg_match($filtro, $campo)) {
                                echo "Formato incorrecto para el campo '$nombreCampo'.";
                                exit;
                            }
                            return htmlspecialchars($campo);
                        }
                        ?>


                    </div>
                </div>
            </div>

            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body">

                        <!-- Alta de Categoría -->
                        <section id="alta_categoria">
                            <h2>Alta de Categoría</h2>
                            <form action="" method="post">
                                <label for="nombre_categoria">Nombre de la Categoría:</label>
                                <input type="text" name="nombre_categoria" required><br>

                                <label for="activo_categoria">Activo:</label>
                                <select name="activo_categoria" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select><br>

                                <label for="cod_categoria_padre">Código de Categoría Padre:</label>
                                <input type="text" name="cod_categoria_padre"><br>

                                <input type="submit" name="crear_categoria" value="Crear Categoría">
                            </form>
                        </section>
                    </div>

                    <div class="card-body">
                        <!-- Baja de Categoría -->
                        <section id="baja_categoria">
                            <h2>Baja de Categoría</h2>
                            <form action="" method="post">
                                <label for="codigo_categoria_eliminar">Seleccionar Categoría por Código:</label>
                                <select name="codigo_categoria_eliminar" required>
                                    <?php
                                    // Obtener las categorías de la base de datos y mostrarlas en el desplegable
                                    $stmt = $conn->query("SELECT codigo, nombre FROM categoria");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"{$row['codigo']}\">{$row['codigo']} - {$row['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" name="eliminar_categoria" value="Eliminar Categoría">
                            </form>
                        </section>
                    </div>
                </div>
            </div>




            <!-- Script PHP para procesar las operaciones -->
            <?php
            // Procesar creación de nueva categoría

            require_once 'conexion.php';

            // Procesar el envío del formulario de alta de categoría
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_categoria'])) {
                $nombre_categoria = $_POST['nombre_categoria'];
                $activo_categoria = $_POST['activo_categoria'];
                $cod_categoria_padre = $_POST['cod_categoria_padre'];

                // Crear una instancia de la clase Database
                $db = new Database();
                // Obtener la conexión
                $conn = $db->getConnection();

                // Verificar si la conexión se estableció correctamente
                if (!$conn) {
                    echo "Error al conectar a la base de datos.";
                    exit();
                }

                // Insertar la categoría en la base de datos
                $stmt = $conn->prepare("INSERT INTO categoria (nombre, activo, codCategoriaPadre) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $nombre_categoria);
                $stmt->bindParam(2, $activo_categoria);
                $stmt->bindParam(3, $cod_categoria_padre);

                if ($stmt->execute()) {
                    echo "Categoría creada exitosamente.";

                    // Verificar si el directorio padre existe y, si no, crearlo
                    $ftp_server = "ftpupload.net"; // Cambiar por la dirección del servidor FTP
                    $ftp_user = "if0_35791061"; // Cambiar por el nombre de usuario del servidor FTP
                    $ftp_pass = "vzg3Z0V5HPk0Ch"; // Cambiar por la contraseña del servidor FTP

                    $conn_id = ftp_connect($ftp_server);
                    $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);

                    if ($login_result) {
                        // Directorio padre
                        $directorio_padre = '/zapatillalandia.infinityfreeapp.com/htdocs/img';

                        // Verificar si el directorio padre existe
                        if (!ftp_chdir($conn_id, $directorio_padre)) {
                            // Si el directorio padre no existe, intentar crearlo
                            if (ftp_mkdir($conn_id, $directorio_padre)) {
                                echo "Directorio padre creado exitosamente.";
                            } else {
                                echo "Error al crear el directorio padre.";
                            }
                        }

                        // Crear la carpeta de imágenes de la categoría en el servidor FTP
                        $carpeta_imagenes = $directorio_padre . '/' . $nombre_categoria;
                        if (ftp_mkdir($conn_id, $carpeta_imagenes)) {
                            echo "Carpeta de imágenes creada exitosamente en el servidor FTP.";
                        } else {
                            echo "Error al crear la carpeta de imágenes en el servidor FTP.";
                        }

                        ftp_close($conn_id);
                    } else {
                        echo "Error al conectarse al servidor FTP.";
                    }
                }
            }


            // Procesar eliminación de categoría
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_categoria'])) {
                $id_categoria_eliminar = $_POST['codigo_categoria_eliminar'];

                try {
                    // Deshabilitar restricción de clave externa temporalmente
                    $conn->exec('SET FOREIGN_KEY_CHECKS=0');

                    // Eliminar categoría de la base de datos
                    $stmt = $conn->prepare("DELETE FROM categoria WHERE codigo = ?");
                    $stmt->bindParam(1, $id_categoria_eliminar);

                    if ($stmt->execute()) {
                        echo "Categoría eliminada exitosamente.";
                    } else {
                        echo "Error al eliminar la categoría.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                } finally {
                    // Volver a habilitar la restricción de clave externa
                    $conn->exec('SET FOREIGN_KEY_CHECKS=1');
                }
            }

            // Procesar modificación de categoría
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar_categoria'])) {
                $id_categoria_modificar = $_POST['id_categoria_modificar'];
                $nombre_categoria_modificado = $_POST['nombre_categoria_nuevo'];
                $activo_categoria_modificado = $_POST['activo'] === '1' ? 1 : 0; // Convertir '1' a 1 y '0' a 0
                $cod_categoria_padre_modificado = $_POST['cod_categoria_padre']; // Si se utiliza categoría padre

                // Actualizar información de la categoría en la base de datos
                $stmt = $conn->prepare("UPDATE categoria SET nombre = ?, activo = ?, codCategoriaPadre = ? WHERE codigo = ?");
                $stmt->bindParam(1, $nombre_categoria_modificado);
                $stmt->bindParam(2, $activo_categoria_modificado);
                $stmt->bindParam(3, $cod_categoria_padre_modificado);
                $stmt->bindParam(4, $id_categoria_modificar);

                if ($stmt->execute()) {
                    echo "Categoría modificada exitosamente.";
                } else {
                    echo "Error al modificar la categoría.";
                }
            }

            // Procesar búsqueda de categoría
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_categoria'])) {
                $nombre_categoria_buscar = $_POST['nombre_categoria_buscar'];

                // Realizar la búsqueda en la base de datos
                $stmt = $conn->prepare("SELECT * FROM categoria WHERE nombre LIKE ?");
                $nombre_categoria_buscar = "%" . $nombre_categoria_buscar . "%"; // Añadir comodines para búsqueda parcial
                $stmt->bindParam(1, $nombre_categoria_buscar);
                $stmt->execute();
                $categorias_encontradas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar resultados de la búsqueda
                if ($categorias_encontradas) {
                    foreach ($categorias_encontradas as $categoria) {
                        echo "Categoría encontrada: " . $categoria['nombre'];
                        // Mostrar más detalles o realizar otras acciones si es necesario
                    }
                } else {
                    echo "No se encontraron categorías con el nombre proporcionado.";
                }
            }
            ?>

            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body">
                        <section id="alta_subcategoria">
                            <h2>Alta de Subcategoría</h2>
                            <form action="" method="post">
                                <label for="nombre_subcategoria">Nombre de la Subcategoría:</label>
                                <input type="text" name="nombre_subcategoria" required><br>

                                <label for="cod_categoria_padre">Categoría Padre:</label>
                                <select name="cod_categoria_padre" required>
                                    <?php
                                    // Obtener las categorías de la base de datos y mostrarlas en el desplegable
                                    $stmt = $conn->query("SELECT codigo, nombre FROM categoria");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"{$row['codigo']}\">{$row['codigo']} - {$row['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                                </select><br>

                                <input type="submit" name="crear_subcategoria" value="Crear Subcategoría">
                            </form>
                        </section>
                    </div>

                    <div class="card-body">
                        <!-- Eliminación de Subcategoría -->

                        <section id="baja_categoria">
                            <h2>Baja de Subcategoría</h2>
                            <form action="" method="post">
                                <label for="id_subcategoria_eliminar">Seleccionar Categoría por Código:</label>
                                <select name="id_subcategoria_eliminar" required>
                                    <?php
                                    // Obtener las subcategorías de la base de datos y mostrarlas en el desplegable
                                    $stmt = $conn->query("SELECT s.codigo, s.nombre AS nombre_subcategoria, c.nombre AS nombre_categoria_padre 
                          FROM subcategoria AS s 
                          LEFT JOIN categoria AS c ON s.codcategoriapadre = c.codigo  ORDER BY c.nombre desc");
                                    while ($subcategoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"{$subcategoria['codigo']}\">{$subcategoria['codigo']} - {$subcategoria['nombre_subcategoria']} - {$subcategoria['nombre_categoria_padre']}</option>";
                                    }
                                    ?>



                                </select>
                                <input type="submit" name="eliminar_subcategoria" value="Eliminar Subategoría">
                            </form>
                        </section>


                        <?php
                        // Procesar creación de nueva subcategoría
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_subcategoria'])) {
                            // Obtener datos del formulario
                            $nuevo_nombre_subcategoria = $_POST['nombre_subcategoria'];
                            $cod_categoria_padre = $_POST['cod_categoria_padre'];

                            // Insertar nueva subcategoría en la base de datos
                            $stmt = $conn->prepare("INSERT INTO subcategoria (nombre, codCategoriaPadre) VALUES (?, ?)");
                            $stmt->bindParam(1, $nuevo_nombre_subcategoria);
                            $stmt->bindParam(2, $cod_categoria_padre);

                            if ($stmt->execute()) {
                                echo "Nueva subcategoría creada exitosamente.";
                            } else {
                                echo "Error al crear la nueva subcategoría.";
                            }
                        }

                        // Procesar eliminación de subcategoría
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_subcategoria'])) {
                            // Obtener ID de la subcategoría a eliminar
                            $id_subcategoria_eliminar = $_POST['id_subcategoria_eliminar'];

                            // Eliminar subcategoría de la base de datos
                            $stmt = $conn->prepare("DELETE FROM subcategoria WHERE codigo = ?");
                            $stmt->bindParam(1, $id_subcategoria_eliminar);

                            if ($stmt->execute()) {
                                echo "Subcategoría eliminada exitosamente.";
                            } else {
                                echo "Error al eliminar la subcategoría.";
                            }
                        }

                        // Procesar modificación de subcategoría
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar_subcategoria'])) {
                            // Obtener datos del formulario
                            $id_subcategoria_modificar = $_POST['id_subcategoria_modificar'];
                            $nombre_subcategoria_nuevo = $_POST['nombre_subcategoria_nuevo'];
                            $cod_categoria_padre_nuevo = $_POST['cod_categoria_padre_nuevo'];

                            // Actualizar información de la subcategoría en la base de datos
                            $stmt = $conn->prepare("UPDATE subcategoria SET nombre = ?, codCategoriaPadre = ? WHERE codigo = ?");
                            $stmt->bindParam(1, $nombre_subcategoria_nuevo);
                            $stmt->bindParam(2, $cod_categoria_padre_nuevo);
                            $stmt->bindParam(3, $id_subcategoria_modificar);

                            if ($stmt->execute()) {
                                echo "Subcategoría modificada exitosamente.";
                            } else {
                                echo "Error al modificar la subcategoría.";
                            }
                        }

                        // Procesar búsqueda de subcategoría
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_subcategoria'])) {
                            // Obtener nombre de la subcategoría a buscar
                            $nombre_subcategoria_buscar = $_POST['nombre_subcategoria_buscar'];

                            // Realizar búsqueda en la base de datos
                            $stmt = $conn->prepare("SELECT * FROM subcategoria WHERE nombre LIKE ?");
                            $nombre_subcategoria_buscar = "%" . $nombre_subcategoria_buscar . "%"; // Añadir comodines para búsqueda parcial
                            $stmt->bindParam(1, $nombre_subcategoria_buscar);
                            $stmt->execute();
                            $subcategorias_encontradas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Mostrar resultados de la búsqueda
                            if ($subcategorias_encontradas) {
                                foreach ($subcategorias_encontradas as $subcategoria) {
                                    // Obtener nombre de la categoría padre
                                    $stmt = $conn->prepare("SELECT nombre FROM categoria WHERE codigo = ?");
                                    $stmt->bindParam(1, $subcategoria['codCategoriaPadre']);
                                    $stmt->execute();
                                    $categoria_padre = $stmt->fetch(PDO::FETCH_ASSOC);

                                    echo "Subcategoría encontrada: " . $subcategoria['nombre'] . " (Pertenece a la categoría: " . $categoria_padre['nombre'] . ")";
                                    // Mostrar más detalles o realizar otras acciones si es necesario
                                }
                            } else {
                                echo "No se encontraron subcategorías con el nombre proporcionado.";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body">

                        <!-- Alta de Artículo -->
                        <section id="alta_articulo">
                            <?php

                            function obtenerSubcategorias($conn, $categoria)
                            {
                                $stmt = $conn->prepare("SELECT codigo, nombre FROM subcategoria WHERE codCategoriaPadre = ?");
                                $stmt->execute([$categoria]);
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                            }


                            // Procesar creación de nuevo artículo
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_articulo'])) {
                                // Obtener datos del formulario
                                $nombre_articulo = $_POST['nombre'];
                                $descripcion_articulo = $_POST['descripcion'];
                                $precio_articulo = $_POST['precio'];
                                $descuento_articulo = $_POST['descuento'];
                                $imagen_articulo = $_FILES['imagen_articulo']['name']; // Nombre del archivo
                                $imagen_temporal = $_FILES['imagen_articulo']['tmp_name']; // Archivo temporal
                                $activo_articulo = $_POST['activo'];
                                $categoria_articulo = $_POST['categoria'];
                                $subcategoria_articulo = $_POST['subcategoria'];

                                // Directorio donde se almacenarán las imágenes
                                $directorio_destino = "C:/xampp/htdocs/daws/tiendavirtual/img/";

                                // Obtener el nombre de la categoría
                                $stmt = $conn->prepare("SELECT nombre FROM categoria WHERE codigo = ?");
                                $stmt->execute([$categoria_articulo]);
                                $nombre_categoria = $stmt->fetchColumn();

                                // Obtener el nombre de la subcategoría
                                $stmt = $conn->prepare("SELECT nombre FROM subcategoria WHERE codigo = ?");
                                $stmt->execute([$subcategoria_articulo]);
                                $nombre_subcategoria = $stmt->fetchColumn();

                                // Concatenar los nombres en la ruta del directorio de destino
                                $directorio_destino .= "$nombre_categoria/$nombre_subcategoria/";

                                // Crear directorio si no existe
                                if (!file_exists($directorio_destino)) {
                                    mkdir($directorio_destino, 0777, true);
                                }

                                // Ruta completa de la imagen de destino
                                $ruta_destino = $directorio_destino . $imagen_articulo;

                                // Mover la imagen al directorio de destino
                                if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
                                    // Insertar nuevo artículo en la base de datos
                                    $stmt = $conn->prepare("INSERT INTO articulos (nombre, descripcion, precio, descuento, imagen, activo, categoria, subcategoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                    $stmt->bindParam(1, $nombre_articulo);
                                    $stmt->bindParam(2, $descripcion_articulo);
                                    $stmt->bindParam(3, $precio_articulo);
                                    $stmt->bindParam(4, $descuento_articulo);
                                    $stmt->bindParam(5, $imagen_articulo);
                                    $stmt->bindParam(6, $activo_articulo);
                                    $stmt->bindParam(7, $categoria_articulo);
                                    $stmt->bindParam(8, $subcategoria_articulo);

                                    if ($stmt->execute()) {
                                        echo "Nuevo artículo creado exitosamente.";
                                        echo "<script>window.location.href = 'paneldeadministrador.php';</script>";
                                        exit();
                                    } else {
                                        echo "Error al crear el nuevo artículo.";
                                    }
                                } else {
                                    echo "Error al subir la imagen.";
                                }
                            }
                            ?>

                            <!-- Formulario para el alta de artículo -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <h2>Alta de Artículo</h2>
                                <label for="nombre">Nombre del Artículo:</label>
                                <input type="text" name="nombre" required><br>

                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" rows="4" cols="50" required></textarea><br>

                                <label for="precio">Precio:</label>
                                <input type="number" name="precio" step="0.01" required><br>

                                <label for="descuento">Descuento:</label>
                                <input type="number" name="descuento" step="0.01"><br>

                                <label for="imagen">Imagen:</label>
                                <input type="file" name="imagen_articulo" accept="image/*" required><br>

                                <label for="activo">Activo:</label>
                                <select name="activo" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select><br>

                                <!-- Desplegable de categorías -->
                                <label>Seleccione una Categoría:</label>
                                <select id="categoria" name="categoria">
                                    <option value="0">Selecciona una opción</option>
                                    <?php


                                    // Obtener las categorías de la base de datos y mostrarlas en el desplegable
                                    $stmt = $conn->query("SELECT codigo, nombre FROM categoria");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"{$row['codigo']}\">{$row['nombre']}</option>";
                                    }
                                    ?>
                                </select><br>

                                <!-- Desplegable de subcategorías -->
                                <label>Seleccione una Subcategoría:</label>
                                <select id="subcategoria" name="subcategoria">
                                    <option value="">Selecciona una categoría primero</option>

                                </select><br>



                                <input type="submit" name="crear_articulo" value="Crear Artículo">
                            </form>


                    </div>
                </div>
            </div>
            <div class="col-md-4" style="display: flex; align-items: stretch; text-align: center;">
                <div class="card bg-light mb-3 w-100">
                    <div class="card-body" id="modificacion_articulo">
                        <?php
                        // Conexión a la base de datos
                        require_once 'conexion.php'; // Asegúrate de incluir el archivo de conexión a la base de datos

                        // Procesar la modificación del artículo
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar_articulo'])) {
                            // Obtener datos del formulario
                            $codigo_articulo = $_POST['codigo_articulo'];
                            $descripcion = $_POST['descripcion'];
                            $precio = $_POST['precio'];
                            $descuento = $_POST['descuento'];

                            // Actualizar detalles del artículo en la base de datos
                            $stmt = $conn->prepare("UPDATE articulos SET descripcion = ?, precio = ?, descuento = ? WHERE codigo = ?");
                            $stmt->execute([$descripcion, $precio, $descuento, $codigo_articulo]);

                            echo "Artículo modificado exitosamente.";
                        }

                        // Obtener todos los artículos existentes en la base de datos
                        $stmt = $conn->query("SELECT codigo, nombre , categoria, subcategoria FROM articulos");
                        $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Obtener todas las categorías existentes en la base de datos
                        $stmt = $conn->query("SELECT codigo, nombre FROM categoria");
                        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);


                        // Obtener todas las categorías existentes en la base de datos
                        $stmt = $conn->query("SELECT codigo, nombre FROM subcategoria");
                        $subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>


                        <!-- Formulario para modificar artículo -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h2>Modificar artículo</h2>
                            <label for="codigo_articulo">Nombre de Artículos:</label>
                            <select name="codigo_articulo" required>
                                <option value="">Selecciona un artículo</option>
                                <?php foreach ($articulos as $articulo) : ?>
                                    <?php
                                    // Obtener el nombre de la categoría del artículo actual
                                    $nombre_categoria = '';
                                    foreach ($categorias as $categoria) {
                                        if ($categoria['codigo'] == $articulo['categoria']) {
                                            $nombre_categoria = $categoria['nombre'];
                                            break;
                                        }
                                    }

                                    // Obtener el nombre de la subcategoría del artículo actual
                                    $nombre_subcategoria = '';
                                    foreach ($subcategorias as $subcategoria) {
                                        if ($subcategoria['codigo'] == $articulo['subcategoria']) {
                                            $nombre_subcategoria = $subcategoria['nombre'];
                                            break;
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $articulo['codigo']; ?>"><?php echo $articulo['nombre'] . ' - ' . $nombre_categoria . ' - ' . $nombre_subcategoria; ?></option>
                                <?php endforeach; ?>
                            </select><br>

                            <label for="descripcion">Nueva Descripción:</label>
                            <textarea name="descripcion" rows="4" cols="50" required></textarea><br>

                            <label for="precio">Nuevo Precio:</label>
                            <input type="number" name="precio" step="0.01" required><br>

                            <label for="descuento">Nuevo Descuento:</label>
                            <input type="number" name="descuento" step="0.01"><br>



                            <input type="submit" name="modificar_articulo" value="Modificar Artículo">
                        </form>
                    </div>




                    <div class="card-body">
                        <section id="baja_modificacion_articulo">
                            <h2>Eliminar Artículo</h2>
                            <!-- Formulario de Búsqueda de Artículo -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <label for="articulo_baja">Selecciona un artículo para dar de baja:</label>
                                <select name="articulo_baja" id="articulo_baja">
                                    <option value="">Selecciona un artículo</option>
                                    <?php
                                    // Obtener los artículos de la base de datos y mostrarlos en el desplegable
                                    $stmt = $conn->query("SELECT a.codigo, a.nombre AS nombre_articulo, c.nombre AS nombre_categoria, s.nombre AS nombre_subcategoria
                      FROM articulos a
                      INNER JOIN categoria c ON a.categoria = c.codigo
                      INNER JOIN subcategoria s ON a.subcategoria = s.codigo");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"{$row['codigo']}\">{$row['codigo']} - {$row['nombre_articulo']} - {$row['nombre_categoria']} - {$row['nombre_subcategoria']}</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                                <input type="submit" name="baja_articulo" value="Dar de baja">
                            </form>

                            <?php
                            // Verificar si se ha enviado el formulario para dar de baja un artículo
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['baja_articulo'])) {
                                // Obtener el código del artículo seleccionado para dar de baja
                                $codigo_articulo = $_POST['articulo_baja'];

                                // Verificar si se ha seleccionado un artículo
                                if (!empty($codigo_articulo)) {
                                    // Realizar la consulta para eliminar el artículo de la base de datos
                                    $stmt = $conn->prepare("DELETE FROM articulos WHERE codigo = ?");
                                    $stmt->execute([$codigo_articulo]);

                                    // Verificar si se eliminó correctamente el artículo
                                    if ($stmt->rowCount() > 0) {
                                        echo "El artículo ha sido eliminado correctamente.";
                                        echo "<script>window.location.href = 'paneldeadministrador.php';</script>";
                                        exit();
                                    } else {
                                        echo "Error al eliminar el artículo.";
                                    }
                                } else {
                                    echo "Por favor, selecciona un artículo para dar de baja.";
                                }
                            }
                            ?>

                    </div>
                </div>
            </div>

            <div class="col-md-12" style="text-align:center;">
                <div class="card bg-light mb-3 w-100">
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
                        // Conexión a la base de datos
                        require_once 'conexion.php'; // Asegúrate de incluir el archivo de conexión a la base de datos
                        // Crear una instancia de la clase Database
                        $database = new Database();

                        // Obtener la conexión a la base de datos
                        $conn = $database->getConnection();

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
                                        $ruta_imagen = obtenerRutaImagen($row['codigo_categoria'], $row['codigo_subcategoria'], $row['imagen'], $conn);

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
                </div>
            </div>

        </DIV>
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