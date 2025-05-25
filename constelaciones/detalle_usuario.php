<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<p style='color:red;'>ID de usuario no válido.</p>";
  exit();
}

$id_usuario = $_GET['id'];
$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$res_usuario = mysqli_query($conexion, $sql_usuario);
$usuario = mysqli_fetch_assoc($res_usuario);

$sql_inscripciones = "SELECT c.nombre, c.modalidad, c.nivel, n.nombre_nivel, i.fecha_inscripcion
                      FROM inscripciones i
                      JOIN cursos c ON i.id_curso = c.id_curso
                      JOIN niveles n ON c.nivel = n.id_nivel
                      WHERE i.id_usuario = $id_usuario";
$res_inscripciones = mysqli_query($conexion, $sql_inscripciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle del Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/panel.css">
</head>
<body>
  <div class="panel-galactico">
    <h2>👤 Detalles de <?php echo $usuario['nickname']; ?></h2>

    <div class="formulario-edicion">
      <p><strong>Nombre completo:</strong> <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></p>
      <p><strong>Correo:</strong> <?php echo $usuario['correo']; ?></p>
      <p><strong>Edad:</strong> <?php echo $usuario['edad']; ?></p>
      <p><strong>Tipo:</strong> <?php echo ucfirst($usuario['tipo_usuario']); ?></p>
    </div>

    <div class="bloque">
      <h3>📚 Cursos inscritos</h3>
      <?php if (mysqli_num_rows($res_inscripciones) > 0): ?>
        <table>
          <tr>
            <th>Curso</th><th>Modalidad</th><th>Nivel</th><th>Fecha de inscripción</th>
          </tr>
          <?php while($c = mysqli_fetch_assoc($res_inscripciones)): ?>
            <tr>
              <td><?php echo $c['nombre']; ?></td>
              <td><?php echo $c['modalidad']; ?></td>
              <td><?php echo $c['nivel'] . ' - ' . $c['nombre_nivel']; ?></td>
              <td><?php echo $c['fecha_inscripcion']; ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else: ?>
        <p>Este usuario aún no se ha inscrito en ningún curso.</p>
      <?php endif; ?>
      <div class="acciones-panel" style="text-align:center; margin-top: 30px;">
      <a href="panel_galactico.php" class="btn-admin">🔙 Volver al Panel</a>
    </div>
  </div>
</body>
</html>