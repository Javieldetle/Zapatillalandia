<?php
session_start();


if(isset($_POST['user'])) {
    $dni = $_POST['user'];

    // Incluir el archivo de conexión a la base de datos
    require_once 'conexion.php';

    try {
        // Crear una instancia de la clase Database
        $database = new Database();
        $conn = $database->getConnection();

        // Consulta SQL para actualizar el campo 'activo' a 1
        $query = "UPDATE usuarios SET activo = 1 WHERE dni = :dni";

        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Bind
        $stmt->bindParam(':dni', $dni);

        // Ejecutar la consulta
        if($stmt->execute()) {
            
            header("Location: paneldeadministrador.php?alta=true");
    exit();
        } else {
            echo "Error al dar de alta al usuario: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error de base de datos: " . $e->getMessage();
    }
} else {
    echo "Error: No se recibió el DNI del usuario.";
}
?>
