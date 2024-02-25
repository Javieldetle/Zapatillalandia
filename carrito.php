<?php
if (!isset($_SESSION['dni_usuario'])) {
    // Si el usuario no ha iniciado sesión, intenta reanudar la sesión anterior si existe
    session_regenerate_id(true); // Genera un nuevo ID de sesión y elimina la sesión anterior si existe

    // Verifica si hay una sesión previa
    if (isset($_COOKIE['PHPSESSID'])) {
        // Intenta iniciar la sesión con el ID de sesión anterior
        if (session_start()) {
            // La sesión se reanudó correctamente, verifica si se estableció el usuario
            if (!isset($_SESSION['dni_usuario'])) {
                // Si el usuario aún no está establecido, redirige a la página de inicio de sesión o muestra un mensaje de error
                header("Location: index.php"); // Cambia 'login.php' por la página de inicio de sesión real
                exit(); // Asegúrate de detener la ejecución del script después de redirigir
            }
        } else {
            // No se pudo reanudar la sesión, muestra un mensaje de error o maneja la situación de otra manera
            echo "Error al reanudar la sesión.";
            exit(); // Asegúrate de detener la ejecución del script
        }
    } else {
        // No hay una sesión previa, redirige a la página de inicio de sesión o muestra un mensaje de error
        header("Location: index.php"); // Cambia 'login.php' por la página de inicio de sesión real
        exit(); // Asegúrate de detener la ejecución del script después de redirigir
    }
}
// Utiliza require_once en lugar de require para incluir el archivo de conexión
require_once 'conexion.php';

// Verificar si se ha enviado un artículo para agregar al carrito
if(isset($_POST['agregar_al_carrito'])) {
    // Obtener los detalles del artículo
    $articulo_id = $_POST['articulo_id'];
    $cantidad = $_POST['cantidad']; // Asegúrate de que estás recibiendo correctamente la cantidad
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    
    // Agregar el artículo al carrito
    agregar_al_carrito($articulo_id, $cantidad, $precio, $descuento);
}

// Función para agregar un artículo al carrito
function agregar_al_carrito($articulo_id, $cantidad, $precio, $descuento) {
    // Verificar si el carrito existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        // Si no existe, inicializar el carrito como un array vacío
        $_SESSION['carrito'] = array();
    }

    // Crear un nuevo elemento para la línea de pedido
    $nueva_linea_pedido = array(
        'articulo_id' => $articulo_id,
        'cantidad' => $cantidad,
        'precio' => $precio,
        'descuento' => $descuento
    );

    // Agregar la nueva línea de pedido al carrito
    $_SESSION['carrito'][] = $nueva_linea_pedido;
}

// Función para calcular el subtotal de una línea de pedido
function calcularSubtotal($cantidad, $precio, $descuento) {
    $subtotal = $cantidad * $precio;
    $subtotal -= $subtotal * ($descuento / 100); // Aplicar descuento si existe
    return $subtotal;
}

// Función para calcular el total del carrito
function calcularTotalCarrito() {
    $total = 0;
    if(isset($_SESSION['carrito'])) {
        foreach($_SESSION['carrito'] as $linea_pedido) {
            $subtotal = calcularSubtotal($linea_pedido['cantidad'], $linea_pedido['precio'], $linea_pedido['descuento']);
            $total += $subtotal;
        }
    }
    return $total;
}

// Función para vaciar el carrito
if (isset($_POST['borrar_carrito'])) {
    vaciarCarrito(); // Llamar a la función para vaciar el carrito
    echo "El carrito ha sido vaciado.";
}
function vaciarCarrito() {
    unset($_SESSION['carrito']);
}

// Función para eliminar un pedido del carrito
if (isset($_POST['eliminar_pedido'])) {
    $index = $_POST['eliminar_pedido'];
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
    }
}

// Función para insertar un pedido en la base de datos
function insertarPedido($dni_usuario) {
    // Verificar si el carrito existe en la sesión
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        return "El carrito está vacío. No se puede realizar el pedido.";
    }

    // Insertar el pedido en la tabla 'pedidos'
    $database = new Database();
    $conexion = $database->getConnection();
    $fecha = date('Y-m-d');
    $total = calcularTotalCarrito();

    // Consulta para insertar el pedido
    $query_insert_pedido = "INSERT INTO pedidos (fecha, total, estado, codusuario, activo) VALUES (:fecha, :total, 1, :cod_usuario, 1)";

    // Preparar la consulta
    $stmt_insert_pedido = $conexion->prepare($query_insert_pedido);

    // Vincular los parámetros
    $stmt_insert_pedido->bindParam(':fecha', $fecha);
    $stmt_insert_pedido->bindParam(':total', $total);
    $stmt_insert_pedido->bindParam(':cod_usuario', $dni_usuario);

    // Ejecutar la consulta
    if ($stmt_insert_pedido->execute()) {
        // Obtener el ID del pedido insertado
        $id_pedido = $conexion->lastInsertId();

        // Insertar las líneas de pedido en la tabla 'lineapedido'
        foreach ($_SESSION['carrito'] as $linea_pedido) {
            $codArticulo = $linea_pedido['articulo_id'];
            $cantidad = $linea_pedido['cantidad'];
            $precio = $linea_pedido['precio'];
            $descuento = $linea_pedido['descuento'];

            $query_insert_linea_pedido = "INSERT INTO lineapedido (numpedido, codArticulo, cantidad, precio, descuento) VALUES (:id_pedido, :codArticulo, :cantidad, :precio, :descuento)";
            $stmt_insert_linea_pedido = $conexion->prepare($query_insert_linea_pedido);
            $stmt_insert_linea_pedido->bindParam(':id_pedido', $id_pedido);
            $stmt_insert_linea_pedido->bindParam(':codArticulo', $codArticulo);
            $stmt_insert_linea_pedido->bindParam(':cantidad', $cantidad);
            $stmt_insert_linea_pedido->bindParam(':precio', $precio);
            $stmt_insert_linea_pedido->bindParam(':descuento', $descuento);
            $stmt_insert_linea_pedido->execute();
        }

        // Limpiar el carrito después de realizar el pedido
       // unset($_SESSION['carrito']);

        return "Pedido realizado correctamente. ID del pedido: $id_pedido";
    } else {
        // Si la consulta falla, obtener y mostrar el error
        $error_info = $stmt_insert_pedido->errorInfo();
        return "Error al realizar el pedido: " . $error_info[2];
    }
}

// Verificar si se ha enviado el formulario para realizar el pedido
if(isset($_POST['realizar_pedido'])) {
    if(isset($_SESSION['dni_usuario'])) {
        $resultado = insertarPedido($_SESSION['dni_usuario']);
        if (strpos($resultado, "Error") === false) {
            // Almacenar el carrito en una sesión para pasarlo a cargarpedido.php
            $_SESSION['carrito'] = $_SESSION['carrito'];
            // Redirigir a cargarpedido.php
            header("Location: pagos.php");
            exit(); // Asegúrate de detener la ejecución del script después de redirigir
        } else {
            echo $resultado; // Si hay un error, mostrar el mensaje de error
        }
    } else {
        echo "El usuario no ha iniciado sesión.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Agregamos FontAwesome para los iconos -->
    <style> 
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Estilos para los botones */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Carrito de Compras</h2>

<table>
    <tr>
        <th>Artículo</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Descuento</th>
        <th>Subtotal</th>
        <th>Acción</th>
    </tr>

    <?php
    // Verificar si existe el carrito en la sesión y si tiene elementos
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Recorrer cada elemento del carrito
        foreach($_SESSION['carrito'] as $index => $linea_pedido) {
            echo '<tr>';
            echo '<td>' . $linea_pedido['articulo_id'] . '</td>';
            echo '<td>' . $linea_pedido['cantidad'] . '</td>';
            echo '<td>' . $linea_pedido['precio'] . '</td>';
            echo '<td>' . $linea_pedido['descuento'] . '</td>';
            echo '<td>' . calcularSubtotal($linea_pedido['cantidad'], $linea_pedido['precio'], $linea_pedido['descuento']) . '</td>';
            echo '<td><form method="post"><input type="hidden" name="eliminar_pedido" value="' . $index . '"><button type="submit"><i class="fas fa-trash-alt"></i></button></form></td>';
            echo '</tr>';
        }
    } else {
        // Si el carrito está vacío, mostrar un mensaje
        echo '<tr><td colspan="6">El carrito está vacío</td></tr>';
    }
    ?>

</table>

<form action="carrito.php" method="post">
    <input type="hidden" name="borrar_carrito">
    <button type="submit">Vaciar Carrito</button>
</form>

<form action="carrito.php" method="post">
    <input type="hidden" name="realizar_pedido">
    <button type="submit">Realizar Pedido</button>
</form>

<p><a href="index.php">Inicio</a></p>

</body>
</html>
