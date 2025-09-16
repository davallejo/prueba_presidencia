<?php
// Configuración de la base de datos PostgreSQL
$host = 'localhost';
$dbname = 'login_system';
$username = 'postgres';  // Cambia si tienes otro usuario
$password = '172107'; // Cambia por tu password de PostgreSQL
$port = '5432';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>