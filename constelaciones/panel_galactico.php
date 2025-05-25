<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

// Verificamos si es administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

// Obtener todos los cursos
$sql_cursos = "SELECT c.*, n.nombre_nivel FROM cursos c JOIN niveles n ON c.nivel = n.id_nivel";
$res_cursos = mysqli_query($conexion, $sql_cursos);

// Obtener todos los usuarios (excepto admins)
$sql_usuarios = "SELECT * FROM usuarios WHERE tipo_usuario = 'alumno'";
$res_usuarios = mysqli_query($conexion, $sql_usuarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Galáctico de Administración</title>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../estilo_cosmico/panel.css">
</head>
<body>
  <div class="panel-galactico">
    <h1>🛸 Panel Galáctico de Administración</h1>

    <div class="acciones-panel">
      <a href="crear_curso.php" class="btn-admin">➕ Crear Nuevo Curso</a>
      <a href="../inicio_estelar.php" class="btn-admin">🏠 Volver al Inicio</a>
    </div>

    <section class="bloque">
      <h2>📚 Cursos del Sistema</h2>
      <table>
        <tr>
          <th>Nombre</th><th>Modalidad</th><th>Nivel</th><th>Cupos</th><th>Acciones</th>
        </tr>
        <?php while($curso = mysqli_fetch_assoc($res_cursos)): ?>
        <tr>
          <td><?php echo $curso['nombre']; ?></td>
          <td><?php echo $curso['modalidad']; ?></td>
          <td><?php echo $curso['nombre_nivel']; ?></td>
          <td><?php echo $curso['cupos']; ?></td>
          <td>
            <a href="editar_curso.php?id=<?php echo $curso['id_curso']; ?>">✏️</a>
            <a href="eliminar_curso.php?id=<?php echo $curso['id_curso']; ?>" onclick="return confirm('¿Eliminar este curso?')">🗑️</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </section>

    <section class="bloque">
      <h2>👥 Usuarios Registrados</h2>
      <table>
        <tr>
          <th>Nickname</th><th>Nombre</th><th>Correo</th><th>Acciones</th>
        </tr>
        <?php while($u = mysqli_fetch_assoc($res_usuarios)): ?>
        <tr>
          <td><?php echo $u['nickname']; ?></td>
          <td><?php echo $u['nombre'] . ' ' . $u['apellido']; ?></td>
          <td><?php echo $u['correo']; ?></td>
          <td>
            <a href="eliminar_usuario.php?id=<?php echo $u['id_usuario']; ?>" onclick="return confirm('¿Eliminar este usuario?')">🗑️</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </section>
  </div>
</body>
</html>
