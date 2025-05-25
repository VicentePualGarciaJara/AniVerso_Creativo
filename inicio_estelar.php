<?php
session_start();
$usuario_activo = isset($_SESSION["nickname"]) ? $_SESSION["nickname"] : null;

// Mostrar bienvenida si recién inició sesión
if (isset($_SESSION["mostrar_bienvenida"])) {
    echo "<script>alert('🌟 Bienvenido/a al AniVerso Creativo, $usuario_activo 🎉');</script>";
    unset($_SESSION["mostrar_bienvenida"]);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>AniVerso Creativo</title>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilo_cosmico/inicio.css">
</head>
<?php include('cometas_compartidos/barra_navegacion.php'); ?>
<body>
  <div class="galaxia-fondo">

    <!-- Avatar si hay sesión -->
    <?php if ($usuario_activo): ?>
      <div class="avatar-galactico">
        <img src="universo_visual/avatar_estelar.jpg" alt="Avatar">
        <p>¡Hola, <?php echo $usuario_activo; ?>! 🌟</p>
      </div>
    <?php endif; ?>

    <!-- Frase principal -->
    <h1 class="frase-ani">¡Explora tu universo creativo con un lápiz estelar!</h1>

    <!-- Ilustración central -->
    <div class="ilustracion-central">
      <img src="universo_visual/clase_espacial.png" alt="Clase flotando en el espacio"class="imagen-flotante" >
    </div>

    <!-- Carrusel de imágenes -->
    <div class="carrusel">
      <div class="imagenes-carrusel">
        <img src="universo_visual/slide1.jpg" class="slide">
        <img src="universo_visual/slide2.jpg" class="slide">
        <img src="universo_visual/slide3.jpg" class="slide">
      </div>
      <button class="anterior">⟨</button>
      <button class="siguiente">⟩</button>
    </div>

    <!-- Botones visuales -->
    <div class="botones-ani">
      <a href="constelaciones/cursos_estelares.php">
        <img src="universo_visual/icono_cursos.jpg" alt="">
        Explorar Cursos
      </a>
      <a href="registro_galactico.php">
        <img src="universo_visual/icono_registro.jpg" alt="">
        Registrarse
      </a>
      <a href="portal_estelar.php">
        <img src="universo_visual/icono_login.jpg" alt="">
        Iniciar Sesión
      </a>
    </div>
  </div>

  <script src="scripts_estelares/inicio.js"></script>
</body>
</html>

