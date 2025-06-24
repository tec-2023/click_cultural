<?php
session_start();

if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'editor'])) {
    echo "<p style='color:red;'>Acceso denegado.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo'];

    $nombre = basename($archivo['name']);
    $rutaDestino = __DIR__ . '/uploads/' . $nombre;
    $tipo = mime_content_type($archivo['tmp_name']);
    $tamanioMaximo = 20 * 1024 * 1024; // 20MB

    if ($archivo['size'] > $tamanioMaximo) {
        echo "<p style='color:red;'>El archivo excede el tamaño permitido de 20MB.</p>";
        exit();
    }

    if (!is_uploaded_file($archivo['tmp_name'])) {
        echo "<p style='color:red;'>Error al cargar el archivo.</p>";
        exit();
    }

    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        header("Location: literatura.php");
        exit();
    } else {
        echo "<p style='color:red;'>No se pudo mover el archivo al directorio de destino.</p>";
        exit();
    }
} else {
    echo "<p style='color:red;'>Solicitud inválida.</p>";
    exit();
}
?>
