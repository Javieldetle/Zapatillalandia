<?php
// Definir la función validarCampo antes de su uso
function validarCampo($campo, $filtro = null, $nombreCampo = null) {
    $campo = trim($campo);
    if ($filtro !== null && !preg_match($filtro, $campo)) {
        echo "Formato incorrecto para el campo '$nombreCampo'.";
        header("refresh:3;url=registrar.php");
        exit;
    }
    return htmlspecialchars($campo);
}

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los campos del formulario
    $dni = validarCampo($_POST['dni'], '/^[0-9]{8}[A-Za-z0-9]$/', 'DNI');
    $nombre = validarCampo($_POST['nombre'], null, 'Nombre');
    $apellido = validarCampo($_POST['apellido'], null, 'apellido');
    $direccion = validarCampo($_POST['direccion'], null, 'Dirección');
    $localidad = validarCampo($_POST['localidad'], null, 'Localidad');
    $provincia = validarCampo($_POST['provincia'], null, 'Provincia');
    $telefono = validarCampo($_POST['telefono'], '/^[0-9]{9}$/', 'Teléfono');
    $email = validarCampo($_POST['email'], null, 'Email');
    $clave = $_POST['clave']; // Almacenar la contraseña sin hashear

    if (!strpos($email, '@')) {
        echo "Formato incorrecto para el campo 'Email'. El correo electrónico debe contener '@'.";
        exit;
    }

    $conexion = new Database();
    $conn = $conexion->getConnection();

    // Verificar si el DNI ya existe
    $stmt = $conn->prepare("SELECT dni FROM usuarios WHERE dni = :dni");
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El DNI ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (dni, nombre, apellido,direccion, localidad, provincia, telefono, email, clave, rol) VALUES (:dni, :nombre,:apellido, :direccion, :localidad, :provincia, :telefono, :email, :clave, 2)");

        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':localidad', $localidad);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':clave', $clave);

        if ($stmt->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            echo "Contraseña: " . $clave;
        } else {
            echo "Error al registrarse.";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <style>
        /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}



    </style>
</head>

<body>
    <h2>Registro</h2>
    <form action="" method="post">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br>


        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required><br>

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" required><br>

        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" pattern="^[0-9]{9}$" title="Formato de teléfono incorrecto." required><br>

        <label for="email">Email:</label>
        <input type="clear" type="email" name="email" required><br>

        <label for="clave">Contraseña:</label>
        <input type="clear" type="password" name="clave" required><br>

        <input type="submit" name="register" value="Registrarse">
    </form>

    <?php
    echo "<div style='text-align: center;'>";
    echo "<h2><a href='index.php' style='text-decoration: none; color: inherit;'><i class='fas fa-home'></i> Volver a Inicio</a></h2>";
    echo "</div>";
    ?>
</body>

</html>


