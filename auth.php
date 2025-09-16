<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Redirigir si ya está logueado
redirectIfLoggedIn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = cleanInput($_POST['username']);
    $password = cleanInput($_POST['password']);
    
    $errors = [];
    
    // Validación backend
    if (empty($username)) {
        $errors[] = "El usuario es requerido";
    }
    
    if (empty($password)) {
        $errors[] = "La contraseña es requerida";
    }
    
    if (empty($errors)) {
        try {
            // Buscar usuario en la base de datos
            $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();
            
            if ($user && verifyPassword($password, $user['password'])) {
                // Login exitoso
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['success'] = "¡Bienvenido, " . $user['username'] . "!";
                
                header('Location: dashboard.php');
                exit();
            } else {
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
            }
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error en el sistema. Inténtelo más tarde.";
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }
}

// Redirigir de vuelta al login
header('Location: index.php');
exit();
?>