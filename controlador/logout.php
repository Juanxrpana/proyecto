<?php
session_start();

if (isset($_SESSION['nombre'])) {
    // Destruye todas las variables de sesión
    session_unset();

    // Destruye la sesión
    session_destroy();
}

// Redirige al usuario a la página de inicio de sesión
header('Location: index.php');
?>
