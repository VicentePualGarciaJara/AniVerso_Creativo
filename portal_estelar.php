<?php
session_start();
include("cometas_compartidos/conexion_estelar.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nickname = $_POST['nickname'];
  $contrasena = $_POST['contrasena'];

  $consulta = "SELECT * FROM usuarios WHERE nickname='$nickname' AND contraseña='$contrasena'";
  $resultado = mysqli_query($conexion, $consulta);

  if (mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION["id_usuario"] = $usuario["id_usuario"];
    $_SESSION["nickname"] = $usuario["nickname"];
    $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];
    $_SESSION["mostrar_bienvenida"] = true;
    header("Location: inicio_estelar.php");
    exit();
  } else {
    $error = "❌ Credenciales incorrectas";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión | AniVerso Creativo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilo_cosmico/login.css">
</head>
<body>
  <div class="login-container">
  <div class="info">
    <h1>¡Bienvenido a AniVerso!</h1>
    <p>🪐 Un universo creativo para explorar tus habilidades con cada curso. <br> Inspírate, aprende y brilla como una estrella.</p>
  </div>

  <div class="login-box caja-neon"> 
    <h2>Iniciar Sesión</h2>
    <form method="POST">
      <label for="nickname">Usuario</label>
      <input type="text" name="nickname" placeholder="Tu nombre estelar" required>

      <label for="contrasena">Contraseña</label>
      <input type="password" name="contrasena" placeholder="********" required>

      <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

      <button type="submit">🚀 Ingresar</button>
      <p class="registro">¿No tienes cuenta? <a href="registro_galactico.php">Regístrate aquí</a></p>
    </form>
  </div>
</div>

</body>
</html>
