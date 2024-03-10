<?php
require('conexion.php'); 
session_start();
$database = new Database(); // Crear una instancia de la clase Database

// Obtener la conexión a la base de datos
$conn = $database->getConnection();

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $dni = $_POST['dni'];
    $nueva_clave = $_POST['clave'];

    // Generar hash de la nueva contraseña
    $clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);

    // Actualizar la contraseña y la contraseña hash en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET clave_hash = ?, clave = ? WHERE dni = ?");
    
    if ($stmt !== false) {
        // Vincular los parámetros y ejecutar la consulta
        $stmt->bindParam(1, $clave_hash);
        $stmt->bindParam(2, $nueva_clave);
        $stmt->bindParam(3, $dni);
        if ($stmt->execute()) {
            echo "<script>alert('Contraseña cambiada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al cambiar la contraseña');</script>";
        }
        // Cerrar la consulta
        $stmt = null;
    } else {
        echo "<script>alert('Error al preparar la consulta');</script>";
    }

    // La conexión se cerrará automáticamente al final del script
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        /* Estilos para la alerta emergente */
        .alert {
            display: none;
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .show {
            display: block;
        }
    </style>
</head>

<body>
    <h2>Cambio de Contraseña</h2>
    <form action="" method="post" onsubmit="return validatePassword()">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="escriba su dni..." required>

        <label for="clave">Nueva Contraseña:</label>
        <input type="password" id="clave" name="clave" value="" required>

        <label for="confirmar_clave">Confirmar Contraseña:</label>
        <input type="password" id="confirmar_clave" name="confirmar_clave" value="" required>

        <input type="submit" value="Cambiar Contraseña">

        <!-- Alerta para mostrar el mensaje de error -->
        <div id="passwordError" class="alert"></div>

        <?php
        echo "<div style='text-align: center;'>";
        echo "<h2><a href='index.php' style='text-decoration: none; color: inherit;'><i class='fas fa-home'></i> Volver a Inicio</a></h2>";
        echo "</div>";
        ?>
    </form>

    <?php
    // Redirigir al usuario al inicio después de 5 segundos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'index.php';
                }, 5000);
              </script>";
    }
    ?>

    <script>
        // Función para validar la contraseña antes de enviar el formulario
        function validatePassword() {
            var password = document.getElementById("clave").value;

            // Expresión regular para validar la contraseña
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[.-@])[A-Za-z.-@]{10,}$/;

            // Verificar si la contraseña cumple con el patrón
            if (!passwordPattern.test(password)) {
                var passwordError = document.getElementById("passwordError");
                passwordError.innerHTML = "La contraseña debe contener al menos una mayúscula, una minúscula, un símbolo (. - @) y tener al menos 10 caracteres.";
                passwordError.classList.add("show");
                return false; // Evitar el envío del formulario
            }

            return true; // Permitir el envío del formulario si la contraseña es válida
        }
    </script>
</body>

</html>
