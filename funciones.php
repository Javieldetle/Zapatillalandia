<?php

function verificarRol($rolPermitido) {
    session_start();

    // Verificar si el usuario ha iniciado sesión y tiene un rol asignado
    if (isset($_SESSION['nombre_usuario']) && isset($_SESSION['rol'])) {
        // Verificar si el rol del usuario coincide con el rol permitido
        switch ($_SESSION['rol']) {
            case 1:
                if ($rolPermitido != 1) {
                    $_SESSION['mensaje'] = "Área restringida. No tiene permiso para acceder.";
                    header("Location: index.php");
                    exit();
                }
                break;
            case 2:
                if ($rolPermitido != 2) {
                    $_SESSION['mensaje'] = "Área restringida. No tiene permiso para acceder.";
                    header("Location: paneldeeditor.php");
                    exit();
                }
                break;
            case 3:
                if ($rolPermitido != 3) {
                    $_SESSION['mensaje'] = "Área restringida. No tiene permiso para acceder.";
                    header("Location: panelcliente.php");
                    exit();
                }
                break;
            default:
                // Si el rol no coincide con ninguno de los permitidos, redirigir al índice
                $_SESSION['mensaje'] = "Área restringida. No tiene permiso para acceder.";
                header("Location: registrar.php");
                exit();
        }
    } else {
        // Si el usuario no ha iniciado sesión o no tiene un rol asignado, redirigir al índice
        $_SESSION['mensaje'] = "Área restringida. No tiene permiso para acceder.";
        header("Location: index.php");
        exit();
    }
}
?>
