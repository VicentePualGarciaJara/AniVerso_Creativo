<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: ../inicio_estelar.php");
  exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  
  // Eliminamos también sus inscripciones para evitar errores de clave foránea
  mysqli_query($conexion, "DELETE FROM inscripciones WHERE id_usuario = $id");

  // Eliminamos el usuario
  $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
  
  if (mysqli_query($conexion, $sql)) {
    header("Location: panel_galactico.php");
  } else {
    echo "<p style='color:red;'>No se pudo eliminar al usuario.</p>";
  }
} else {
  echo "<p style='color:red;'>ID de usuario no válido.</p>";
}
?>