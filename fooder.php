

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
<div class="col-xs-12 col-28 text-end">
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


