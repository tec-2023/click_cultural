<?php
$host = 'bftqnnnc5pf8whimwwqw-mysql.services.clever-cloud.com';       // o 127.0.0.1
$db = 'bftqnnnc5pf8whimwwqw';       // nombre de tu base de datos
$usuario = 'uhomadpnpxcqmz1e';         // cambia si tu usuario es diferente
$clave = 'Tu0oPwxZAqzVqHKqM7Xj';               // pon la contraseña de tu MySQL si tiene

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
