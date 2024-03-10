<?php
session_start();
function generarClaveHash($clave) {
    return password_hash($clave, PASSWORD_DEFAULT);
}
?>
<?php
// Definir la función validarCampo antes de su uso
function validarCampo($campo, $filtro = null, $nombreCampo = null) {
    $campo = trim($campo);
    if ($filtro !== null && !preg_match($filtro, $campo)) {
        echo "Formato incorrecto para el campo '$nombreCampo'.";
        exit;
    }
    return htmlspecialchars($campo);
}

require_once 'conexion.php';
require_once 'clavehash.php'; // Incluir el archivo que contiene la función para generar la hash de la contraseña

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los campos del formulario
    $dni = validarCampo($_POST['dni'], '/^[0-9]{8}[A-Za-z0-9]$/', 'dni');
    $nombre = validarCampo($_POST['nombre'], null, 'Nombre');
    $apellido = validarCampo($_POST['apellido'], null, 'apellido');
    $direccion = validarCampo($_POST['direccion'], null, 'Dirección');
    $localidad = validarCampo($_POST['localidad'], null, 'Localidad');
    $provincia = validarCampo($_POST['provincia'], null, 'Provincia');
    $telefono = validarCampo($_POST['telefono'], '/^[0-9]{9}$/', 'Teléfono');
    $email = validarCampo($_POST['email'], null, 'Email');
    $clave = $_POST['clave']; // Almacenar la contraseña sin hashear

    // Verificar que la contraseña cumple con los requisitos
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[.-@])[A-Za-z.-@]{10,}$/', $clave)) {
        echo "La contraseña debe contener al menos una mayúscula, una minúscula, un símbolo (. - @) y tener al menos 10 caracteres.";
        exit;
    }

    $clave_hash = generarClaveHash($clave); // Generar hash de la contraseña usando la función del archivo clavehash.php

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
        $stmt = $conn->prepare("INSERT INTO usuarios (dni, nombre, apellido, direccion, localidad, provincia, telefono, email, clave, clave_hash, rol) VALUES (:dni, :nombre, :apellido, :direccion, :localidad, :provincia, :telefono, :email, :clave, :clave_hash, 3)");

        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':localidad', $localidad);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':clave', $clave); // Almacenar la contraseña original
        $stmt->bindParam(':clave_hash', $clave_hash); // Almacenar el hash de la contraseña

        if ($stmt->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            echo "Error al registrarse.";
        }
    }
}
?>
