<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../portal_estelar.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$res_usuario = mysqli_query($conexion, $sql_usuario);
$usuario = mysqli_fetch_assoc($res_usuario);

$sql_cursos = "SELECT c.nombre, c.modalidad, c.nivel, n.nombre_nivel, i.fecha_inscripcion
               FROM inscripciones i
               JOIN cursos c ON i.id_curso = c.id_curso
               JOIN niveles n ON c.nivel = n.id_nivel
               WHERE i.id_usuario = $id_usuario AND i.estado = 'activa'";
$res_cursos = mysqli_query($conexion, $sql_cursos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil Galáctico</title>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/perfil.css">
</head>
<?php include('../cometas_compartidos/barra_navegacion.php'); ?>

<body>
  <div class="contenedor-perfil">
    <div class="tarjeta-perfil">
      <img src="../universo_visual/avatar1.jpg" alt="Avatar">
      <h1><?php echo $usuario['nickname']; ?></h1>
      <p><strong>Nombre:</strong> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></p>
      <p><strong>Correo:</strong> <?php echo $usuario['correo']; ?></p>
      <p><strong>Edad:</strong> <?php echo $usuario['edad']; ?> años</p>
      <p><strong>Tipo:</strong> <?php echo ucfirst($usuario['tipo_usuario']); ?></p>
    </div>

    <div class="cursos-inscritos">
      <h2>📘 Cursos Inscritos</h2>
      <?php if (mysqli_num_rows($res_cursos) > 0): ?>
        <ul>
          <?php while($curso = mysqli_fetch_assoc($res_cursos)): ?>
            <li>
              <h3><?php echo $curso['nombre']; ?></h3>
              <p>Modalidad: <?php echo $curso['modalidad']; ?></p>
              <p>Nivel <?php echo $curso['nivel']; ?> - <?php echo $curso['nombre_nivel']; ?></p>
              <p>Inscrito el: <?php echo $curso['fecha_inscripcion']; ?></p>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <p>Aún no estás inscrito en ningún curso.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>