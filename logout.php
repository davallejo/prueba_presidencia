<?php
require_once 'includes/functions.php';

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión completamente
session_destroy();

// Mensaje de despedida
session_start();
$_SESSION['success'] = "Has cerrado sesión exitosamente.";

// Redirigir al login
header('Location: index.php');
exit();
?>