<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<p style='color:red;'>ID de curso inválido</p>";
  exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM cursos WHERE id_curso = $id";
$res = mysqli_query($conexion, $sql);
$curso = mysqli_fetch_assoc($res);

// Obtener niveles para el select
$niveles = mysqli_query($conexion, "SELECT * FROM niveles");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST['nombre'];
  $modalidad = $_POST['modalidad'];
  $nivel = $_POST['nivel'];
  $cupos = $_POST['cupos'];
  $descripcion = $_POST['descripcion'];
  $imagen = $_POST['imagen'];

  $update = "UPDATE cursos SET nombre='$nombre', modalidad='$modalidad', nivel=$nivel, cupos=$cupos, descripcion='$descripcion', imagen='$imagen' WHERE id_curso=$id";

  if (mysqli_query($conexion, $update)) {
    header("Location: panel_galactico.php");
  } else {
    echo "<p style='color:red;'>Error al actualizar el curso.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Curso</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/panel.css">
</head>
<?php include('../cometas_compartidos/barra_navegacion.php'); ?>
<body>
  <div class="formulario-edicion">
    <h2>📝 Editar Curso</h2>
    <form method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?php echo $curso['nombre']; ?>" required>

      <label>Modalidad:</label>
      <select name="modalidad">
        <option value="presencial" <?php if($curso['modalidad']=='presencial') echo 'selected'; ?>>Presencial</option>
        <option value="digital" <?php if($curso['modalidad']=='digital') echo 'selected'; ?>>Digital</option>
      </select>

      <label>Nivel:</label>
      <select name="nivel">
        <?php while($n = mysqli_fetch_assoc($niveles)): ?>
          <option value="<?php echo $n['id_nivel']; ?>" <?php if($n['id_nivel']==$curso['nivel']) echo 'selected'; ?>>
            <?php echo $n['nombre_galactico']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label>Cupos:</label>
      <input type="number" name="cupos" value="<?php echo $curso['cupos']; ?>" required>

      <label>Descripción:</label>
      <textarea name="descripcion" required><?php echo $curso['descripcion']; ?></textarea>

      <label>Nombre de imagen (archivo):</label>
      <input type="text" name="imagen" value="<?php echo $curso['imagen']; ?>" required>

      <button type="submit">💾 Guardar Cambios</button>
    </form>
  </div>
</body>
</html>
