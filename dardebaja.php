<?php
session_start();
// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['user'])) {
        $dni = $_POST['user']; 

        // Crear una instancia de la clase Database
        $database = new Database();
        $conn = $database->getConnection();

        // Consulta SQL para actualizar el campo 'activo' a 0 filtrando por el campo 'dni'
        $query = "UPDATE usuarios SET activo = 0 WHERE dni = :dni";

        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Bind
        $stmt->bindParam(':dni', $dni);

        // Ejecutar la consulta
        if($stmt->execute()) {
            echo "La cuenta ha sido dada de baja correctamente.";
            header("Location: logout.php");
            exit();
        } else {
            echo "Error al dar de baja la cuenta.";
            // Agrega un mensaje para depuración
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>