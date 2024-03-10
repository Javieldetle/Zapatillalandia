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
        <div class="col-md-4 order-md-1" style="border-right:1px solid #ccc;">
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
                </body>
                   
                    