<?php
session_start();
require_once 'conexion.php';

// Procesar eliminación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_usuario'])) {
    $dni_a_eliminar = $_POST['dni_a_eliminar'];

    // Crear una instancia de la clase Database
    $db = new Database();
    // Obtener la conexión
    $conn = $db->getConnection();

    // Verificar si la conexión se estableció correctamente
    if (!$conn) {
        echo "Error al conectar a la base de datos.";
        exit();
    }

    // Comenzar una transacción para garantizar la consistencia de los datos
    $conn->beginTransaction();

    try {
        // Eliminar registros relacionados en la tabla lineapedido
        $stmt = $conn->prepare("DELETE FROM lineapedido WHERE dni = ?");
        $stmt->bindParam(1, $dni_a_eliminar);
        $stmt->execute();

        // Eliminar registros relacionados en la tabla pedidos
        $stmt = $conn->prepare("DELETE FROM pedidos WHERE codusuario = ?");
        $stmt->bindParam(1, $dni_a_eliminar);
        $stmt->execute();

        // Eliminar el usuario
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE dni = ?");
        $stmt->bindParam(1, $dni_a_eliminar);
        $stmt->execute();

        // Confirmar la transacción si todo se realizó correctamente
        $conn->commit();

        echo "Usuario eliminado exitosamente.";
        // Redirigir al panel de administrador
        header("Location: paneldeadministrador.php");
        exit();
    } catch (PDOException $e) {
        // Si ocurre algún error, deshacer la transacción y mostrar un mensaje de error
        $conn->rollback();
        echo "Error al eliminar el usuario: " . $e->getMessage();
    }
}
?>
