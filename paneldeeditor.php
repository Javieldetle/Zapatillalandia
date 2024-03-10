<?php
require_once 'funciones.php';
verificarRol(2);
require_once 'conexion.php'; // Incluir el archivo de conexión
require_once 'mostrar_imagenes.php'; // Incluir el archivo mostrar_imagenes.php

// Iniciar la sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['nombre_usuario'])) {
    // Si no hay una sesión iniciada, redirigir a la página de inicio de sesión
    header("Location: index.php");
    exit(); // Salir del script
}

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        #tablainforme table th:last-child,
#tablainforme table td:last-child {
    display: none;
}

        header.container-fluid.py-3 {
            display: none;
        }

        .botones-container {
    margin: 20px 0; /* Margen superior e inferior */
}
.botones-container {
    display: flex; /* Utilizar flexbox para alinear los botones */
    justify-content: space-around; /* Alinear los elementos a los extremos */
    margin-bottom: 10 px; /* Espacio entre los botones y el siguiente contenido */
}

.boton-container {
    flex: 12; /* Que los botones ocupen el mismo espacio disponible */
    margin-right: 10 px; /* Margen entre los botones */
}
#cancelarpedido,
#mostrarInforme {
    background-color: transparent; /* Fondo transparente */
    border: 2px solid; /* Borde sólido */
    padding:  20px; /* Padding interno */
    border-radius: 4 px; /* Bordes redondeados */
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s; /* Transición suave */
    width: 30 px; /* Ancho del botón, teniendo en cuenta el margen entre ellos */
}

#cancelarpedido {
    border-color: red; /* Borde rojo */
    color: white; /* Texto blanco */
    background-color: red; /* Fondo rojo */
}

#mostrarInforme {
    border-color: green; /* Borde verde */
    color: white; /* Texto blanco */
    background-color: green; /* Fondo verde */
}

#cancelarpedido:hover,
#mostrarInforme:hover {
    background-color: rgba(0, 128, 0, 0.8); /* Fondo verde al pasar el ratón */
}


    </style>

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
            <div class="col-xs-4 col-sm-4 col-md-2" style="border-right:1px solid #ccc;">
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
            <div class="col-xs-6 col-sm-6 col-md-8" style="text-align:center;">
                <h1>Panel de Editor</h1>



                <!-- Mostrar todos los usuarios -->

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

                <h3>Lista de Usuarios</h3>
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
           <div class="botones-container">
    <form method="POST" action="tablapedidos.php">
        <input type="hidden" name="cancelar_pedido" value="true">
        <input type="hidden" name="id_pedido" value="ID_DEL_PEDIDO_A_CANCELAR"> <!-- Reemplaza ID_DEL_PEDIDO_A_CANCELAR por el ID real del pedido -->
        <div class="boton-container">
            <button type="submit" id="cancelarpedido">Cancelar Pedido</button>
        </div>
    </form>
    <div class="boton-container">
        <button id="mostrarInforme">Informe de Pedidos</button>
    </div>
</div>

<!-- Contenedor para mostrar el informe de pedidos -->
<div id="informePedidos"></div>

<script>
    $(document).ready(function() {
        // Función para cargar el contenido de tablapedidos.php al hacer clic en el botón
        $("#mostrarInforme").click(function() {
            // Usar AJAX para cargar el contenido de tablapedidos.php dentro del div informePedidos
            $("#informePedidos").load("tablapedidos.php?informe=true");
        });
    });
</script>
           

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
                            </section></br>
                            <!-- Formulario para el informe de pedidos -->


                        </div>
                    </div>
                </div>


                <div class="col-md-2">
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