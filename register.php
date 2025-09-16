<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Redirigir si ya está logueado
redirectIfLoggedIn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $confirm_password = cleanInput($_POST['confirm_password']);
    
    $errors = [];
    
    // Validación backend
    if (empty($username)) {
        $errors[] = "El usuario es requerido";
    } elseif (strlen($username) < 3) {
        $errors[] = "El usuario debe tener al menos 3 caracteres";
    }
    
    if (empty($email)) {
        $errors[] = "El email es requerido";
    } elseif (!isValidEmail($email)) {
        $errors[] = "Ingrese un email válido";
    }
    
    if (empty($password)) {
        $errors[] = "La contraseña es requerida";
    } elseif (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres";
    }
    
    if (empty($confirm_password)) {
        $errors[] = "Confirme la contraseña";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    if (empty($errors)) {
        try {
            // Verificar si el usuario o email ya existen
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            
            if ($stmt->fetch()) {
                $errors[] = "El usuario o email ya están registrados";
            } else {
                // Crear nuevo usuario
                $hashedPassword = hashPassword($password);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                
                if ($stmt->execute([$username, $email, $hashedPassword])) {
                    $_SESSION['success'] = "Usuario registrado exitosamente. Ya puedes iniciar sesión.";
                    header('Location: index.php');
                    exit();
                } else {
                    $errors[] = "Error al registrar el usuario";
                }
            }
        } catch(PDOException $e) {
            $errors[] = "Error en el sistema. Inténtelo más tarde.";
        }
    }
    
    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Autenticación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2 class="form-title">Crear Cuenta</h2>
        
        <?php
        // Mostrar mensajes de error
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-error'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <form id="registerForm" action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" placeholder="Ingrese un usuario" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese una contraseña">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme la contraseña">
            </div>

            <button type="submit" class="btn">Crear Cuenta</button>
        </form>

        <div class="link">
            <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a></p>
        </div>
    </div>

    <script src="js/validation.js"></script>
</body>
</html>