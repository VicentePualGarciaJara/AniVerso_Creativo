<?php
session_start();
include('../cometas_compartidos/conexion_estelar.php');

// 1. Verificamos si hay sesión activa
if (!isset($_SESSION['id_usuario'])) {
    echo "<p style='color:red;'>Debes iniciar sesión para inscribirte en un curso. 🚫</p>";
    exit();
}

// 2. Obtenemos los datos
$id_usuario = $_SESSION['id_usuario'];
$nickname = $_SESSION['nickname'];
$estado = "activo";

if (!isset($_GET['id_curso']) || !is_numeric($_GET['id_curso'])) {
    echo "<p style='color:red;'>Curso no válido. ❌</p>";
    exit();
}

$id_curso = $_GET['id_curso'];

// 3. Verificamos si ya está inscrito
$verificar = "SELECT * FROM inscripciones WHERE id_usuario = $id_usuario AND id_curso = $id_curso";
$res_verificar = mysqli_query($conexion, $verificar);

if (mysqli_num_rows($res_verificar) > 0) {
    echo "<p style='color:orange;'>Ya estás inscrito en este curso. 🌟</p>";
    echo "<a href='detalle_curso.php?id=$id_curso'>Volver al curso</a>";
    exit();
}

// 4. Insertamos la inscripción
$sql = "INSERT INTO inscripciones (id_usuario, id_curso, nickname_usuario, fecha_inscripcion, estado)
        VALUES ($id_usuario, $id_curso, '$nickname', CURDATE(), '$estado')";

if (mysqli_query($conexion, $sql)) {
    echo "<h2 style='color:lime;'>✨ ¡Inscripción exitosa! Estás dentro del AniVerso Creativo. ✨</h2>";
    echo "<a href='perfil_cosmico.php'>Ir a mi perfil</a>";
} else {
    echo "<p style='color:red;'>Ocurrió un error al inscribirte: " . mysqli_error($conexion) . "</p>";
}
?>
