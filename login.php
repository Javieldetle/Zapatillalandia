<?php
error_reporting(0);
session_start(); // Iniciar sesión

// Verificar si el usuario ya inició sesión
if (isset($_SESSION['nombre_usuario'])) {
    // Redirigir al usuario según su rol
    switch ($_SESSION['rol']) {
        case '1':
            header("Location: paneldeadministrador.php");
            break;
        case '2':
            header("Location: paneldeeditor.php");
            break;
        case '3':
            header("Location: panelcliente.php");
            break;
        default:
            header("Location: registrar.php");
            break;
    }
    exit(); // Asegurar que el script se detenga después de redirigir
}

// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado el nombre de usuario y la contraseña
    if (isset($_POST['user']) && isset($_POST['key'])) {
        $usuario = $_POST['user'];
        $clave = $_POST['key'];

        // Crear una instancia de la clase Database
        $database = new Database();
        $conn = $database->getConnection();
        
        // Consulta SQL para verificar las credenciales
        $query = "SELECT * FROM usuarios WHERE nombre = :usuario";

        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Bind
        $stmt->bindParam(':usuario', $usuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener la fila como un arreglo asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario en la base de datos
        if ($row) {
            // Verificar si la contraseña ingresada coincide con la contraseña almacenada
            if ($clave === $row['clave']) { // Comparación de texto plano
                // Las credenciales son correctas, iniciar sesión y redirigir al usuario
                $_SESSION['nombre_usuario'] = $row['nombre'];
                $_SESSION['dni_usuario'] = $row['dni'];
                $_SESSION['rol'] = $row['rol'];
                // Redirigir al usuario a la página correspondiente según su rol
                switch ($row['rol']) {
                    case '1':
                        header("Location: paneldeadministrador.php");
                        break;
                    case '2':
                        header("Location: paneldeeditor.php");
                        break;
                    case '3':
                        header("Location: panelcliente.php");
                        break;
                    default:
                        header("Location: registrar.php");
                        break;
                }
                exit();
            } else {
                // La contraseña es incorrecta
                echo "La contraseña es incorrecta. Inténtalo de nuevo.";
            }
        } else {
            // El usuario no fue encontrado en la base de datos
            echo "<span style='font-size: larger;'>El usuario no existe. Por favor, regístrate.</span>";
            header("refresh:5; url=registrar.php");
            exit(); // Asegurar que el script se detenga después de redirigir
        }
    } else {
        // Datos de inicio de sesión incompletos
        echo "Por favor, ingresa tu nombre de usuario y contraseña.";
    }
}
?>
