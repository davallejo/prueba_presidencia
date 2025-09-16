<?php
session_start();

// Verificar si el usuario está autenticado
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirigir si no está autenticado
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

// Redirigir si ya está autenticado
function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header('Location: dashboard.php');
        exit();
    }
}

// Limpiar datos de entrada
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validar email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Verificar contraseña
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Hashear contraseña
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Mostrar mensajes flash
function showMessage($type, $message) {
    if (isset($_SESSION[$type])) {
        echo "<div class='alert alert-$type'>" . $_SESSION[$type] . "</div>";
        unset($_SESSION[$type]);
    }
}
?>