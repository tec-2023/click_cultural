<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destino = "info@centroculturaljcu.edu.ni";
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $asunto = htmlspecialchars($_POST["asunto"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n";
    $contenido .= "Asunto: $asunto\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($destino, "Contacto Web: $asunto", $contenido, $headers)) {
        echo "<h2>¡Mensaje enviado correctamente!</h2><p>Gracias por contactarnos, $nombre.</p>";
        echo "<meta http-equiv='refresh' content='5;url=contacto.html'>";
    } else {
        echo "<h2>Error al enviar el mensaje.</h2><p>Por favor, inténtalo de nuevo más tarde.</p>";
        echo "<meta http-equiv='refresh' content='5;url=contacto.html'>";
    }
} else {
    header("Location: contacto.html");
    exit();
}
?>