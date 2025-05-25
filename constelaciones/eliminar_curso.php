<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  // Eliminamos las inscripciones primero para evitar errores
  mysqli_query($conexion, "DELETE FROM inscripciones WHERE id_curso = $id");

  // Eliminamos el curso
  $sql = "DELETE FROM cursos WHERE id_curso = $id";

  if (mysqli_query($conexion, $sql)) {
    header("Location: panel_galactico.php");
  } else {
    echo "<p style='color:red;'>No se pudo eliminar el curso.</p>";
  }
} else {
  echo "<p style='color:red;'>ID de curso no válido.</p>";
}
?>