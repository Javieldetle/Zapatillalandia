<?php
error_reporting(0);
session_start();
require_once 'conexion.php';

// Verificar si el usuario está autenticado y es un usuario registrado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario autenticado
$nombre_usuario = $_SESSION['nombre_usuario'];

// Consultar la base de datos para obtener los datos del usuario
$conexion = new Database();
$conn = $conexion->getConnection();

// Obtener el ID del usuario a editar o eliminar desde la URL
$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;

// Obtener los datos del usuario a editar
$datosUsuario = obtenerDatosUsuario($usuario_id);

// Verificar si el usuario tiene permisos para editar
if ($datosUsuario['nombre'] == $nombre_usuario) {
    // Editar datos del usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_datos'])) {
        // Obtener los nuevos datos del formulario
        $nuevo_nombre = $_POST['nuevo_nombre'];
        $nueva_direccion = $_POST['nueva_direccion'];
        $nueva_localidad = $_POST['nueva_localidad'];
        $nueva_provincia = $_POST['nueva_provincia'];
        $nuevo_telefono = $_POST['nuevo_telefono'];
        $nuevo_email = $_POST['nuevo_email'];

        // Actualizar los datos en la base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET 
            nombre = :nuevo_nombre,
            direccion = :nueva_direccion,
            localidad = :nueva_localidad,
            provincia = :nueva_provincia,
            telefono = :nuevo_telefono,
            email = :nuevo_email
            WHERE id = :usuario_id");

        $stmt->bindParam(':nuevo_nombre', $nuevo_nombre);
        $stmt->bindParam(':nueva_direccion', $nueva_direccion);
        $stmt->bindParam(':nueva_localidad', $nueva_localidad);
        $stmt->bindParam(':nueva_provincia', $nueva_provincia);
        $stmt->bindParam(':nuevo_telefono', $nuevo_telefono);
        $stmt->bindParam(':nuevo_email', $nuevo_email);
        $stmt->bindParam(':usuario_id', $usuario_id);

        if ($stmt->execute()) {
            echo "Datos actualizados exitosamente.";
            // Actualizar los datos del usuario en la sesión
            $_SESSION['nombre_usuario'] = $nuevo_nombre;
        } else {
            echo "Error al actualizar los datos.";
        }
    }

    // Mostrar formulario de edición
    echo "<h3>Editar mis datos:</h3>";
    echo "<form action='' method='post'>";
    echo "Nombre: <input type='text' name='nuevo_nombre' value='" . ($datosUsuario['nombre'] ?? '') . "' required><br>";
    echo "Dirección: <input type='text' name='nueva_direccion' value='" . ($datosUsuario['direccion'] ?? '') . "' required><br>";
    echo "Localidad: <input type='text' name='nueva_localidad' value='" . ($datosUsuario['localidad'] ?? '') . "' required><br>";
    echo "Provincia: <input type='text' name='nueva_provincia' value='" . ($datosUsuario['provincia'] ?? '') . "' required><br>";
    echo "Teléfono: <input type='text' name='nuevo_telefono' value='" . ($datosUsuario['telefono'] ?? '') . "' required><br>";
    echo "Email: <input type='text' name='nuevo_email' value='" . ($datosUsuario['email'] ?? '') . "' required><br>";
    echo "<input type='submit' name='editar_datos' value='Guardar cambios'>";
    echo "</form>";
} else {
    echo "No tienes permisos para editar este usuario.";
}

// Función para obtener los datos del usuario
function obtenerDatosUsuario($usuarioId)
{
    $conexion = new Database();
    $conn = $conexion->getConnection();

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :usuario_id");
    $stmt->bindParam(':usuario_id', $usuarioId);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>




