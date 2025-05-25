<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<style>
.navbar-galactica {
  background: linear-gradient(to right, #5A189A, #00BBF9);
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
}

.navbar-galactica a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
  font-weight: bold;
  transition: all 0.3s;
}

.navbar-galactica a:hover {
  text-shadow: 0 0 10px white;
}

.navbar-galactica .menu {
  display: flex;
  align-items: center;
}

.navbar-galactica .logo {
  font-size: 20px;
  font-weight: bold;
  color: #fff;
  font-family: 'Bangers', cursive;
}
</style>

<div class="navbar-galactica">
  <div class="logo">AniVerso Creativo 🚀</div>
  <div class="menu">
    <a href="/aniverso_creativo/inicio_estelar.php">🏠 Inicio</a>
    <a href="/aniverso_creativo/constelaciones/cursos_estelares.php">📚 Cursos</a>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <a href="/aniverso_creativo/constelaciones/panel_galactico.php">🛸 Panel Admin</a>
      <a href="/aniverso_creativo/constelaciones/perfil_cosmico.php">👤 Perfil</a>
      <a href="/aniverso_creativo/expulsion_espacial.php">🚪 Cerrar sesión</a>
    <?php else: ?>
      <a href="/aniverso_creativo/portal_estelar.php">🔑 Iniciar sesión</a>
      <a href="/aniverso_creativo/registro_galactico.php">📝 Registro</a>
    <?php endif; ?>
  </div>
</div>
