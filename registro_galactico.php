<?php
// 🔌 1. Conectamos a la base de datos
include('cometas_compartidos/conexion_estelar.php');
session_start();
$error = "";

// ✨ 2. Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 🔍 3. Capturamos los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $telefono = $_POST["telefono"];
    $edad = $_POST["edad"];
    $nickname = $_POST["nickname"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $tipo = "alumno";

    // 🌌 4. Creamos la consulta para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, apellido, cedula, telefono, edad, nickname, correo, contraseña, tipo_usuario)
            VALUES ('$nombre', '$apellido', '$cedula', '$telefono', $edad, '$nickname', '$correo', '$contraseña', '$tipo')";

    // 🚀 5. Ejecutamos la consulta
    if (mysqli_query($conexion, $sql)) {
        $_SESSION["mensaje_exito"] = "⭐ ¡Usuario registrado con éxito en el AniVerso! ⭐";
        header("Location: portal_estelar.php");
        exit();
    } else {
        $error = "❌ Error al registrar usuario: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Galáctico</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Quicksand&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo_cosmico/registro.css">
</head>
<body>
    <div class="container">
        <!-- LADO IZQUIERDO: Imagen -->
        <div class="left-panel">
            <div class="overlay"></div>
            <img src="universo_visual/registro 1.jpg" alt="fondo galáctico">
        </div>

        <!-- LADO DERECHO: Formulario -->
        <div class="right-panel">
            <h2>🪐 Registro Galáctico</h2>

            <!-- Mensaje de error visual si existe -->
            <?php if (!empty($error)) : ?>
                <div class="mensaje-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="text" name="cedula" placeholder="Cédula" required>
                <input type="text" name="telefono" placeholder="Teléfono">
                <input type="number" name="edad" placeholder="Edad">
                <input type="text" name="nickname" placeholder="Nickname" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                
                <button type="submit">🚀 Crear cuenta estelar</button>
            </form>

            <p>¿Ya tienes una cuenta? <a href="portal_estelar.php">✨ Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>
