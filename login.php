<?php
session_start();
require_once 'conexion.php'; // conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Buscar usuario por nombre
    $stmt = $pdo->prepare("SELECT u.id, u.nombre_usuario, u.password_hash, r.nombre AS rol
                           FROM usuarios u
                           JOIN roles r ON u.rol_id = r.id
                           WHERE u.nombre_usuario = ?");
    $stmt->execute([$usuario]);
    $usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioBD && password_verify($password, $usuarioBD['password_hash'])) {
        // Credenciales correctas
        $_SESSION['usuario_id'] = $usuarioBD['id'];
        $_SESSION['usuario'] = $usuarioBD['nombre_usuario'];
        $_SESSION['rol'] = $usuarioBD['rol'];

        // Redirigir según rol
        header("Location: literatura.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.html';</script>";
    }
}
?>
