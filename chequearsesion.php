<?php
session_start();

if (isset($_SESSION['nombre_usuario'])) {
    echo 'conectado';
} else {
    echo 'desconectado'; session_destroy();
}
?>