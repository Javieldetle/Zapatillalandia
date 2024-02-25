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
        .bg-golden {
            background-color: #EABE3F;
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
    </style>
</head>

<body>

<section id="seccion2" class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img class="d-block img-fluid" src="img/logo/zapatilla_logo.png" width="20%" alt="logo Zapatilla">
        </div>
        <div class="col-md-12">
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
        class="row justify-content-end">
        <div class="col-xs-12 col-sm-4 col-md-3;  margin-left: 125 px;">
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

    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2" style="border-right:1px solid #ccc;">
            <aside>
                <!-- Contenido del aside aquí -->
            </aside>
        </div>
        <!-- Otros elementos de la sección -->
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
            <p>Página en construcción</p>
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
