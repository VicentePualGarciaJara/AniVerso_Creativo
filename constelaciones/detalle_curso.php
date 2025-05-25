<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='color:red'>Curso no válido</p>";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT cursos.*, niveles.nombre_nivel FROM cursos 
        JOIN niveles ON cursos.nivel = niveles.id_nivel 
        WHERE cursos.id_curso = $id";

$resultado = mysqli_query($conexion, $sql);
if (mysqli_num_rows($resultado) == 0) {
    echo "<p style='color:red'>Curso no encontrado</p>";
    exit();
}
$curso = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $curso['nombre']; ?> - Detalles</title>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/detalle.css">
</head>
<?php include('../cometas_compartidos/barra_navegacion.php'); ?>

<body>
  <div class="contenedor-detalle">
    <img src="../universo_visual/<?php echo $curso['imagen']; ?>" alt="Imagen del curso">
    <div class="info">
      <h1><?php echo $curso['nombre']; ?></h1>
      <p class="descripcion"><?php echo $curso['descripcion']; ?></p>
      <p><strong>Modalidad:</strong> <?php echo $curso['modalidad']; ?></p>
      <p><strong>Nivel:</strong> <?php echo $curso['nivel'] . " - " . $curso['nombre_nivel']; ?></p>
      <p><strong>Cupos disponibles:</strong> <?php echo $curso['cupos']; ?></p>

      <div class="materiales">
        <h3>📦 Materiales Incluidos</h3>
        <ul>
          <li>🖊️ Lápices de dibujo HB, 2B y 6B</li>
          <li>📓 Sketchbook de 60 hojas (formato A4)</li>
          <li>🧼 Goma blanca y moldeable</li>
          <li>🎨 Paleta digital (Clip Studio Paint o Krita)</li>
          <li>🖱️ Tableta gráfica Wacom o XP-Pen</li>
          <li>📚 Acceso a biblioteca digital estelar</li>
        </ul>
      </div>

      <div class="temas">
        <h3>🪐 Temas que exploraremos</h3>
        <ul>
          <li>✏️ Trazos básicos y proporciones</li>
          <li>🌠 Sombreados galácticos y perspectiva</li>
          <li>👩‍🎨 Diseño de personajes estilo anime</li>
          <li>📖 Narrativa visual y composición</li>
          <li>🖌️ Técnicas mixtas y pintura digital</li>
        </ul>
      </div>

      <div class="portadas-libros">
        <h3>📕 Libros que ofrece el curso </h3>
        <img src="../universo_visual/libro1.jpg" alt="Portada 1">
        <img src="../universo_visual/libro2.jpg" alt="Portada 2">
      </div>

      <?php if (isset($_SESSION['id_usuario'])): ?>
        <div class="botones-acciones">
  <a class="boton-inscribir" href="inscribir_usuario.php?id_curso=<?php echo $curso['id_curso']; ?>">🌠 ¡Inscribirme!</a>
  <a class="boton-volver" href="cursos_estelares.php">🔙 Volver al Catálogo</a>
</div>
      <?php else: ?>
        <p style="color:yellow">Inicia sesión para poder inscribirte 🚀</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>


