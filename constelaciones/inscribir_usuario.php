<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

// 1. Verificamos si hay sesión activa
if (!isset($_SESSION['id_usuario'])) {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Inscripción</title>
      <link rel="stylesheet" href="../estilo_cosmico/inscripcion.css">
    </head>
    <body>
      <div class="mensaje error">🚫 Debes iniciar sesión para inscribirte en un curso.</div>
    </body>
    </html>';
    exit();
}

// 2. Obtenemos los datos
$id_usuario = $_SESSION['id_usuario'];
$nickname = $_SESSION['nickname'];
$estado = "activa";

if (!isset($_GET['id_curso']) || !is_numeric($_GET['id_curso'])) {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Error</title>
      <link rel="stylesheet" href="../estilo_cosmico/inscripcion.css">
    </head>
    <body>
      <div class="mensaje error">❌ Curso no válido.</div>
    </body>
    </html>';
    exit();
}

$id_curso = $_GET['id_curso'];

// 3. Verificamos si ya está inscrito
$verificar = "SELECT * FROM inscripciones WHERE id_usuario = $id_usuario AND id_curso = $id_curso";
$res_verificar = mysqli_query($conexion, $verificar);

if (mysqli_num_rows($res_verificar) > 0) {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Inscripción</title>
      <link rel="stylesheet" href="../estilo_cosmico/inscripcion.css">
    </head>
    <body>
      <div class="mensaje advertencia">Ya estás inscrito en este curso. 🌟</div>
      <a class="boton-volver" href="detalle_curso.php?id=' . $id_curso . '">Volver al curso</a>
    </body>
    </html>';
    exit();
}

// 4. Insertamos la inscripción
$sql = "INSERT INTO inscripciones (id_usuario, id_curso, nickname_usuario, fecha_inscripcion, estado)
        VALUES ($id_usuario, $id_curso, '$nickname', CURDATE(), '$estado')";

if (mysqli_query($conexion, $sql)) {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Inscripción</title>
      <link rel="stylesheet" href="../estilo_cosmico/inscripcion.css">
    </head>
    <body>
      <div class="mensaje exito">✨ ¡Inscripción exitosa! Estás dentro del AniVerso Creativo. ✨</div>
      <a class="boton-volver" href="perfil_cosmico.php">Ir a mi perfil</a>
    </body>
    </html>';
} else {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Error</title>
      <link rel="stylesheet" href="../estilo_cosmico/inscripcion.css">
    </head>
    <body>
      <div class="mensaje error">❌ Ocurrió un error al inscribirte: ' . mysqli_error($conexion) . '</div>
    </body>
    </html>';
}
?>