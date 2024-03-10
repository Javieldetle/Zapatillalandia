
<?php
session_start();
require_once "conexion.php";

// Verificar si el usuario está autenticado y es un usuario registrado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario autenticado y su rol
$nombre_usuario = $_SESSION['nombre_usuario'];
$rol_usuario = $_SESSION['rol']; // Asegúrate de que el rol esté almacenado en la sesión
$dni_usuario = $_SESSION['dni_usuario'];

// Verificar el rol del usuario
if ($rol_usuario != 2) { // Cambia 2 por el ID de rol requerido para editar los pedidos
    echo "No tienes permisos para editar pedidos de otros usuarios.";
    exit();
}

// Obtener el ID del usuario actual
$usuario_id = isset($_GET['dni_usuario']) ? $_GET['dni_usuario'] : null;

// Si no se proporciona un ID de usuario específico, obtener todos los pedidos
if (!$usuario_id) {
    // No se proporcionó un ID de usuario específico, obtener todos los pedidos
    $pedidos = obtenerTodosPedidos();
} else {
    // Se proporcionó un ID de usuario específico, obtener los pedidos de ese usuario
    $pedidos = obtenerPedidosUsuario($usuario_id);
}
function obtenerPedidosUsuario($usuarioId)
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT p.idpedido, p.fecha, p.estado, COUNT(pl.idpedido) AS lineas, SUM(pl.cantidad * a.precio) AS Total, u.nombre AS nombre_usuario, u.dni AS dni_usuario
                            FROM pedidos p
                            LEFT JOIN lineapedido pl ON p.idpedido = pl.numpedido
                            LEFT JOIN articulos a ON pl.codarticulo = a.codigo
                            LEFT JOIN usuarios u ON p.codusuario = u.dni
                            WHERE p.codusuario = :dni
                            GROUP BY p.idpedido");
    $stmt->bindParam(':dni', $usuarioId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Función para obtener todos los pedidos si el usuario tiene permisos para verlos
function obtenerTodosPedidos()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT u.apellido, p.idpedido, p.fecha, p.estado, COUNT(pl.numpedido) AS lineas, SUM(pl.cantidad * a.precio) AS Total, u.nombre AS nombre_usuario, u.dni AS dni_usuario
                            FROM pedidos p
                            LEFT JOIN lineapedido pl ON p.idpedido = pl.numpedido
                            LEFT JOIN articulos a ON pl.codarticulo = a.codigo
                            LEFT JOIN usuarios u ON p.codusuario = u.dni
                            GROUP BY p.idpedido");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Si se envió el formulario de cancelación de pedido
if (isset($_POST['cancelar_pedido'])) {
    // Verificar si se recibió el ID del pedido a cancelar
    if (isset($_POST['id_pedido'])) {
        // Obtener el ID del pedido a cancelar
        $idPedido = $_POST['id_pedido'];

        try {
            // Establecer la conexión a la base de datos
            $conexion = new Database();
            $conn = $conexion->getConnection();

            // Preparar la consulta SQL para actualizar el estado del pedido a "Cancelado"
            $stmt = $conn->prepare("UPDATE pedidos SET estado = 2 WHERE idpedido = :idPedido");

            // Vincular los parámetros
            $stmt->bindParam(':idPedido', $idPedido);

            // Ejecutar la consulta
            $stmt->execute();

            // Redirigir a la misma página después de la cancelación
            header("Location: tablapedidos.php");
            exit();
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos
            echo "Error al cancelar el pedido: " . $e->getMessage();
        }
    } else {
        echo "ID del pedido no recibido.";
    }
}
// Función para obtener la cantidad de pedidos cancelados
function obtenerCantidadPedidosCancelados()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) AS cantidad FROM pedidos WHERE estado = 2");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['cantidad'];
}

// Función para obtener la cantidad de pedidos enviados
function obtenerCantidadPedidosEnviados()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) AS cantidad FROM pedidos WHERE estado = 1");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['cantidad'];
}


// Obtener la cantidad de pedidos cancelados
$cantidad_cancelados = obtenerCantidadPedidosCancelados();

// Obtener la cantidad de pedidos enviados
$cantidad_enviados = obtenerCantidadPedidosEnviados();

// Obtener la cantidad de pedidos pendientes
$cantidad_pendientes = obtenerCantidadPedidosPendientes();

// Función para obtener la cantidad de pedidos pendientes
function obtenerCantidadPedidosPendientes()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) AS cantidad FROM pedidos WHERE estado = 0");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['cantidad'];
}

// Función para obtener el total de euros de los pedidos cancelados
function obtenerTotalEurosCancelados()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT SUM(pl.cantidad * a.precio) AS total_euros
                            FROM pedidos p
                            LEFT JOIN lineapedido pl ON p.idpedido = pl.numpedido
                            LEFT JOIN articulos a ON pl.codarticulo = a.codigo
                            WHERE p.estado = 2");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['total_euros'];
}

// Función para obtener el total de euros de los pedidos enviados
function obtenerTotalEurosEnviados()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT SUM(pl.cantidad * a.precio) AS total_euros
                            FROM pedidos p
                            LEFT JOIN lineapedido pl ON p.idpedido = pl.numpedido
                            LEFT JOIN articulos a ON pl.codarticulo = a.codigo
                            WHERE p.estado = 1");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['total_euros'];
}

// Función para obtener el total de euros de los pedidos pendientes
function obtenerTotalEurosPendientes()
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT SUM(pl.cantidad * a.precio) AS total_euros
                            FROM pedidos p
                            LEFT JOIN lineapedido pl ON p.idpedido = pl.numpedido
                            LEFT JOIN articulos a ON pl.codarticulo = a.codigo
                            WHERE p.estado = 0");
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['total_euros'];
}

// Obtener la cantidad de pedidos cancelados
$cantidad_cancelados = obtenerCantidadPedidosCancelados();

// Obtener la cantidad de pedidos enviados
$cantidad_enviados = obtenerCantidadPedidosEnviados();

// Obtener la cantidad de pedidos pendientes
$cantidad_pendientes = obtenerCantidadPedidosPendientes();

// Obtener el total de euros de los pedidos cancelados
$total_euros_cancelados = obtenerTotalEurosCancelados();

// Obtener el total de euros de los pedidos enviados
$total_euros_enviados = obtenerTotalEurosEnviados();

// Obtener el total de euros de los pedidos pendientes
$total_euros_pendientes = obtenerTotalEurosPendientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Pedidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Personaliza la apariencia de la tabla */
        .container {
            margin-top: 50px;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .table tbody tr:hover {
            background-color: #f2f2f2;
        }
        .btn-cancelar {
            background-color: #5cb85c; /* Cambia el color a verde claro */
            color: #fff;
            border: none;
        }
        .btn-cancelar:hover {
            background-color: #4cae4c; /* Color más oscuro al pasar el ratón */
            color: #fff;
            
        }
        h3 {
            text-align: center;
        }
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

    </style>
</head>
<body>
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
                                <a class="nav-link" href="paneldeeditor.php">PANEL DE EDITOR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tablapedidos.php">CANCELAR PEDIDO</a>
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
    <div class="container" id = "tablainforme">
        <h3 class="mb-4">Informacion de Pedidos:</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Cantidad de Líneas</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['nombre_usuario'] ?></td>
                            <td><?= $pedido['apellido'] ?></td>
                            <td><?= $pedido['dni_usuario'] ?></td> <!-- Muestra el DNI del usuario -->
                            <td><?= $pedido['idpedido'] ?></td>
                            <td><?= $pedido['fecha'] ?></td>
                            <td>
                                <?php
                                // Determinar el estado del pedido según el valor en la columna "estado"
                                switch ($pedido['estado']) {
                                    case 0:
                                        echo 'Pendiente';
                                        break;
                                    case 1:
                                        echo 'Enviado';
                                        break;
                                    case 2:
                                        echo 'Cancelado';
                                        break;
                                    default:
                                        echo 'Desconocido';
                                }
                                ?>
                            </td>
                            <td><?= $pedido['lineas'] ?></td>
                            <td>€<?= $pedido['Total'] ?></td> <!-- Agrega el símbolo euro -->
                            <td>
                                <!-- Formulario para cancelar el pedido -->
                                <form method="POST" action="">
                                    <input type="hidden" name="id_pedido" value="<?= $pedido['idpedido'] ?>">
                                    <button type="submit" name="cancelar_pedido" class="btn btn-cancelar">Cancelar Pedido</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container" id = "tablatotales">
    <h3 class="mb-4">Informe de Pedidos</h3>
        <div class="row">
            <div class="col-md-4">
                <h4>Pedidos Cancelados</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Total Euros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $cantidad_cancelados ?></td>
                            <td>€<?= $total_euros_cancelados ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h4>Pedidos Enviados</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Total Euros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $cantidad_enviados ?></td>
                            <td>€<?= $total_euros_enviados ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h4>Pedidos Pendientes</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Total Euros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $cantidad_pendientes ?></td>
                            <td>€<?= $total_euros_pendientes ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mostrar la tabla correspondiente según la opción seleccionada en el menú desplegable
        document.getElementById("tipo_pedido").addEventListener("change", function() {
            var tipoPedido = this.value;
            document.getElementById("tabla_pedido_cancelado").style.display = "none";
            document.getElementById("tabla_pedido_enviado").style.display = "none";
            document.getElementById("tabla_pedido_pendiente").style.display = "none";
            document.getElementById("tabla_pedido_" + tipoPedido).style.display = "block";
        });
    </script>
</body>
</html>
