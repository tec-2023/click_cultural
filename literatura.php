<?php
session_start();
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'publico';
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Literatura Estudiantil - CLICK CULTURAL</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Roboto&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="literatura.css" />
</head>
<body>
  <header>
    <div class="container">
      <h1>CLICK CULTURAL</h1>
      <nav>
        <a href="index.html">Inicio</a>
        <a href="galerias.html">Galerías</a>
        <a href="literatura.php">Literatura</a>
        <a href="compromiso.html">Compromiso</a>
        <a href="colaboradores.html">Colaboradores</a>
        <a href="blog-project/blog.html">Blog</a>
        <a href="contacto.html">Contacto</a>
      </nav>
    </div>
  </header>

  <main class="section">
    <div class="container">
      <h2>Poemas y Cuentos de los Estudiantes</h2>

      <div class="literatura-list">
        <section class="obra">
          <h3>El Sol y la Luna</h3>
          <p class="autor">Por: Ana Martínez</p>
          <p class="texto">
            El sol brilla en el cielo,<br>
            la luna lo observa en silencio,<br>
            juntos bailan en el firmamento,<br>
            regalando luz y sueños.
          </p>
        </section>
        <section class="obra">
          <h3>El Viaje Mágico</h3>
          <p class="autor">Por: Luis Pérez</p>
          <p class="texto">
            Había una vez un niño que viajó en un barco de papel...<br>
            (Aquí va el cuento completo del estudiante)
          </p>
        </section>
      </div>

      <h2>Videos de los Estudiantes</h2>
      <div class="videos-list">
        <div class="video-item">
          <h4>Recitando "El Sol y la Luna"</h4>
          <p class="autor">Por: Ana Martínez</p>
          <video width="320" controls>
            <source src="video1.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
          </video>
        </div>
        <div class="video-item">
          <h4>Cuento: El Viaje Mágico</h4>
          <p class="autor">Por: Luis Pérez</p>
          <video width="320" controls>
            <source src="video2.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
          </video>
        </div>
      </div>

      <?php if ($rol === 'admin' || $rol === 'editor'): ?>
      <section class="form-contacto">
        <h3 style="text-align:center; color:#00ffb0;">Panel de Administración</h3>
        <form action="procesar_subida.php" method="POST" enctype="multipart/form-data">
          <label for="archivo">Seleccionar archivo</label>
          <input type="file" name="archivo" id="archivo" required>
          <button type="submit">Subir archivo</button>
        </form>
      </section>
      <?php endif; ?>

      <section class="form-contacto">
        <h3 style="text-align:center; color:#00ffb0;">Archivos subidos</h3>
        <ul style="list-style: none; padding-left: 0;">
          <?php
          $archivos = glob("uploads/*.*");
          if ($archivos) {
            foreach ($archivos as $archivo) {
              $nombre = basename($archivo);
              echo "<li style='margin: 8px 0;'><a href='$archivo' target='_blank' style='color:#2ecc40;'>📁 $nombre</a></li>";
            }
          } else {
            echo "<li>No hay archivos disponibles aún.</li>";
          }
          ?>
        </ul>
      </section>

    </div>
  </main>

  <footer>
    &copy; 2025 CLICK CULTURAL | Todos los derechos reservados
  </footer>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');
    if(menuToggle && navMenu){
      menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('nav-closed');
      });
    }
  </script>
</body>
</html>
