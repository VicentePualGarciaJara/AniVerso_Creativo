<?php
session_start();

include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

// Obtener niveles para el select
$niveles = mysqli_query($conexion, "SELECT * FROM niveles");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $modalidad = $_POST['modalidad'];
  $nivel = $_POST['nivel'];
  $cupos = $_POST['cupos'];
  $descripcion = $_POST['descripcion'];
  $imagen = $_POST['imagen'];

  $sql = "INSERT INTO cursos (nombre, modalidad, nivel, cupos, descripcion, imagen)
          VALUES ('$nombre', '$modalidad', $nivel, $cupos, '$descripcion', '$imagen')";

  if (mysqli_query($conexion, $sql)) {
    header("Location: panel_galactico.php");
  } else {
    echo "<p style='color:red;'>Error al crear el curso: " . mysqli_error($conexion) . "</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Curso</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/panel.css">
</head>
<?php include('../cometas_compartidos/barra_navegacion.php'); ?>
<body>
  <div class="formulario-creacion">
    <h2>➕ Crear Nuevo Curso</h2>
    <form method="POST">
      <label>Nombre del curso:</label>
      <input type="text" name="nombre" required>

      <label>Modalidad:</label>
      <select name="modalidad">
        <option value="presencial">Presencial</option>
        <option value="digital">Digital</option>
      </select>

      <label>Nivel:</label>
      <select name="nivel">
        <?php while($n = mysqli_fetch_assoc($niveles)): ?>
          <option value="<?php echo $n['id_nivel']; ?>">
            <?php echo $n['nombre_nivel']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label>Cupos:</label>
      <input type="number" name="cupos" required>

      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea>

      <label>Nombre del archivo de imagen:</label>
      <input type="text" name="imagen" required>

      <button type="submit">🚀 Crear Curso</button>
    </form>
  </div>
</body>
</html>