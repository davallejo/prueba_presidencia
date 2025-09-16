<?php
require_once 'includes/functions.php';

// Verificar que el usuario esté autenticado
requireLogin();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - Sistema de Autenticación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard">
        <?php
        // Mostrar mensaje de bienvenida
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        ?>

        <h1>¡Bienvenido al Panel!</h1>
        
        <div class="user-info">
            <h3>Información del Usuario</h3>
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p><strong>ID de Sesión:</strong> <?php echo session_id(); ?></p>
            <p><strong>Hora de acceso:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <div>
            <h3>Panel Protegido</h3>
            <p>Esta es un área protegida que solo pueden ver los usuarios autenticados.</p>
            <p>Las contraseñas están hasheadas con bcrypt para mayor seguridad.</p>
            <p>La sesión se maneja con $_SESSION de PHP.</p>
        </div>

        <a href="logout.php" class="btn logout-btn">Cerrar Sesión</a>
    </div>
</body>
</html>