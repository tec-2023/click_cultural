<?php
// filepath: c:\Users\starb\OneDrive\Escritorio\subir.php
$usuario = 'admin';
$contrasena = 'tu_contraseña_segura';

if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] !== $usuario || 
    $_SERVER['PHP_AUTH_PW'] !== $contrasena) {
    header('WWW-Authenticate: Basic realm="Zona Administrador"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Acceso restringido solo para administradores.';
    exit;
}
// filepath: c:\Users\starb\OneDrive\Escritorio\subir.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $archivo = $_FILES['archivo'];

    $destino = 'uploads/' . basename($archivo['name']);
    if (move_uploaded_file($archivo['tmp_name'], $destino)) {
        echo "Archivo subido correctamente.";
        // Aquí puedes guardar la información en una base de datos si lo deseas
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
