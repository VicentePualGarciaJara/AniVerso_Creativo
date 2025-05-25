<?php
session_start();
if (!isset($_SESSION["nickname"])) {
    header("Location: ../portal_estelar.php");
    exit();
}

include('../cometas_compartidos/conexion_estelar.php');

// Consulta los cursos
$sql = "SELECT * FROM cursos";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cursos Estelares</title>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/cursos.css">
</head>
<?php include('../cometas_compartidos/barra_navegacion.php'); ?>
<body>
  <div class="contenedor-catalogo">
    <h1>🛰️ Catálogo de Cursos Estelares</h1>

    <div class="contenedor-tarjetas">
      <?php while($curso = mysqli_fetch_assoc($resultado)): ?>
        <div class="tarjeta-curso">
          <img src="../universo_visual/<?php echo $curso['imagen']; ?>" alt="Imagen del curso">
          <h2><?php echo $curso['nombre']; ?></h2>
          <p><strong>Modalidad:</strong> <?php echo $curso['modalidad']; ?></p>
          <p><strong>Nivel:</strong> <?php echo $curso['nivel']; ?></p>
          <p><strong>Cupos:</strong> <?php echo $curso['cupos']; ?></p>
          <a href="detalle_curso.php?id=<?php echo $curso['id_curso']; ?>">⭐ Ver más</a>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
