<?php
session_start();
include('cometas_compartidos/conexion_estelar.php');

// Procesamiento del login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST["nickname"];
    $contraseña = $_POST["contraseña"];

    $consulta = "SELECT * FROM usuarios WHERE nickname='$nickname' AND contraseña='$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nickname"] = $usuario["nickname"];
        $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];
        // ✨ Activar mensaje de bienvenida UNA sola vez
        $_SESSION["mostrar_bienvenida"] = true;
        header("Location: inicio_estelar.php"); // Redirige al catálogo
        exit();
    } else {
        $error = "❌ Credenciales incorrectas, revisa tu nickname o contraseña.";
    }
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portal Estelar</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo_cosmico/login.css">
</head>
<body>
    <div class="container">
        <!-- Lado izquierdo con portal galáctico -->
        <div class="left-panel">
            <div class="overlay"></div>
            <img src="universo_visual/loginE.jpg" alt="Portal mágico galáctico nuevo">
        </div>

        <!-- Lado derecho con login -->
        <div class="right-panel">
            <h2>🚪 Portal Estelar</h2>

            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

            <form method="POST">
                <input type="text" name="nickname" placeholder="Nickname" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button type="submit">🚀 Iniciar Sesión</button>
            </form>

            <p>¿No tienes cuenta aún? <a href="registro_galactico.php">✨ Crear cuenta</a></p>
        </div>
    </div>
</body>
</html>
