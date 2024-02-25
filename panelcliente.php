<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Virtual</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-HHYOzNUbFp9I6jWZ0ugdWzJybG51cjY/9NnsDOK5M4Fhha/Oj2C0tHckJDdpkM0j+aE8WT6STxSOybn+7zm0XA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
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

        .bg-golden {
            background-color: #EABE3F;
            /* Código hexadecimal para el color dorado */
            /* O puedes usar otros formatos como RGB o el nombre del color */
        }

        .brand-title {
            font-size: 50px;
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
    </style>
</head>

<body>

    <section id="seccion2" class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img class="d-block img-fluid" src="img/logo/zapatilla_logo.png" width="60%" alt="logo Zapatilla">
            </div>

            <div class="col-md-10">
                <div class="col-md-2 text-center">
                    <h1 class="brand-title">Zapatillalandia</h1>
                </div>
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

            <div class="col-md-12 d-flex justify-content-end"> <!-- Cambiado col-sm-4 por col-md-6 para hacerla más ancha -->
                <form name="buscar" method="GET" action="index.php" class="w-45"> <!-- Agregado clase "w-100" para hacer que el formulario ocupe todo el ancho -->
                    <div class="input-group">
                        <input type="text" name="buscar" class="form-control form-control-sm fw-light" style="width: 400px;" placeholder="Buscar productos" value=""> <!-- Aumentado el ancho del input -->
                        <div class="input-group-btn input-group-sm">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>





        <div class="row text-center mb-2" style="background-color:#EABE3F; height: 3px; margin-top: 20px;">
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
            <div class="col-md-8">
                <?php
               
               

                // Verificar si el usuario ya inició sesión
                if (!isset($_SESSION['nombre_usuario'])) {
                    // Redirigir al usuario al formulario de inicio de sesión si no ha iniciado sesión
                    header("Location: iniciar_sesion.php");
                    exit(); // Asegurar que el script se detenga después de redirigir
                }

                // Incluir el archivo de conexión a la base de datos
                require_once 'conexion.php';

                // Verificar si el usuario tiene el rol de cliente (rol = 3)
                if ($_SESSION['rol'] != '3') {
                    // Si el usuario no es un cliente, redirigirlo a la página de inicio adecuada
                    switch ($_SESSION['rol']) {
                        case '1':
                            header("Location: paneldeadministrador.php");
                            break;
                        case '2':
                            header("Location: paneldeeditor.php");
                            break;
                        default:
                            header("Location: index.php");
                            break;
                    }
                    exit(); // Asegurar que el script se detenga después de redirigir
                }

                // Obtener el DNI del usuario de la sesión
                $dni_usuario = $_SESSION['dni_usuario'];

                // Crear una instancia de la clase Database
                $database = new Database();
                $conn = $database->getConnection();

                // Consulta SQL para obtener los datos del usuario
                $query = "SELECT * FROM usuarios WHERE dni = :dni";

                // Preparar la consulta
                $stmt = $conn->prepare($query);

                // Bind
                $stmt->bindParam(':dni', $dni_usuario);

                // Ejecutar la consulta
                $stmt->execute();

                // Obtener la fila como un arreglo asociativo
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar si se encontró el usuario en la base de datos
                if (!$usuario) {
                    // Si el usuario no existe, mostrar un mensaje de error
                    echo "Usuario no encontrado en la base de datos.";
                    exit(); // Asegurar que el script se detenga después de mostrar el mensaje de error
                }

                // Si se envió el formulario
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Verificar si se enviaron los datos necesarios
                    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['direccion']) && isset($_POST['localidad']) && isset($_POST['provincia']) && isset($_POST['telefono']) && isset($_POST['email'])) {
                        // Actualizar los datos del usuario en la base de datos
                        $query = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, direccion = :direccion, localidad = :localidad, provincia = :provincia, telefono = :telefono, email = :email WHERE dni = :dni";

                        // Preparar la consulta
                        $stmt = $conn->prepare($query);

                        // Bind
                        $stmt->bindParam(':nombre', $_POST['nombre']);
                        $stmt->bindParam(':apellido', $_POST['apellido']);
                        $stmt->bindParam(':direccion', $_POST['direccion']);
                        $stmt->bindParam(':localidad', $_POST['localidad']);
                        $stmt->bindParam(':provincia', $_POST['provincia']);
                        $stmt->bindParam(':telefono', $_POST['telefono']);
                        $stmt->bindParam(':email', $_POST['email']);
                        $stmt->bindParam(':dni', $dni_usuario);

                        // Ejecutar la consulta
                        if ($stmt->execute()) {
                            // Actualizar los datos en la sesión
                            $_SESSION['nombre'] = $_POST['nombre'];
                            $_SESSION['apellido'] = $_POST['apellido'];
                            $_SESSION['direccion'] = $_POST['direccion'];
                            $_SESSION['localidad'] = $_POST['localidad'];
                            $_SESSION['provincia'] = $_POST['provincia'];
                            $_SESSION['telefono'] = $_POST['telefono'];
                            $_SESSION['email'] = $_POST['email'];

                            // Mostrar mensaje de éxito
                            echo "¡Los datos se han actualizado correctamente!";
                        } else {
                            // Mostrar mensaje de error
                            echo "Error al actualizar los datos. Por favor, inténtalo de nuevo.";
                        }
                    } else {
                        // Mostrar mensaje de error si no se enviaron todos los datos necesarios
                        echo "Por favor, completa todos los campos del formulario.";
                    }
                }
                ?>

                <h2>Modificar Datos de Perfil</h2>

                <!-- Formulario para modificar los datos del perfil -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>"><br>
                    <label for="apellido">Apellido:</label><br>
                    <input type="text" id="apellido" name="apellido" value="<?php echo isset($_SESSION['apellido']) ? $_SESSION['apellido'] : ''; ?>"><br>
                    <label for="direccion">Dirección:</label><br>
                    <input type="text" id="direccion" name="direccion" value="<?php echo isset($_SESSION['direccion']) ? $_SESSION['direccion'] : ''; ?>"><br>
                    <label for="localidad">Localidad:</label><br>
                    <input type="text" id="localidad" name="localidad" value="<?php echo isset($_SESSION['localidad']) ? $_SESSION['localidad'] : ''; ?>"><br>
                    <label for="provincia">Provincia:</label><br>
                    <input type="text" id="provincia" name="provincia" value="<?php echo isset($_SESSION['provincia']) ? $_SESSION['provincia'] : ''; ?>"><br>
                    <label for="telefono">Teléfono:</label><br>
                    <input type="text" id="telefono" name="telefono" value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>"><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br><br>
                    <input type="submit" name="submit" value="Actualizar Perfil">
                </form>

                <!-- Tabla para mostrar los datos actuales del perfil -->
                <table border="1">
                    <tr>
                        <th>Campo</th>
                        <th>Dato Actual</th>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><?php echo isset($_SESSION['apellido']) ? $_SESSION['apellido'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td><?php echo isset($_SESSION['direccion']) ? $_SESSION['direccion'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Localidad</td>
                        <td><?php echo isset($_SESSION['localidad']) ? $_SESSION['localidad'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Provincia</td>
                        <td><?php echo isset($_SESSION['provincia']) ? $_SESSION['provincia'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td><?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2" style="border-left:1px solid #ccc;">
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
        <div class="row">
            <footer class="panel-footer bg-golden text-white text-center">
                <p class="mb-0">Copyright&copy; 2024 Zapatilandia</p>
            </footer>
        </div>
    </section>

</body>

</html>