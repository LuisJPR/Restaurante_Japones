<?php
    session_start();

    if (isset($_SESSION['usuario'])) {
        header("Location: user.php");
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="IMG/restaurant.ico">
    <link rel="stylesheet" type="text/css" href="CSS/login_register.css">
    <title>Ingresar | Clientes</title>
</head>

<body>

  <div class="back-link">
    <a href="index.html" class="volver-link">
      <span class="icono-volver">
        <img id="icon-back" src="IMG/arrow-left-solid.svg" alt="Icono volver">
      </span>
      <span class="link-text">Volver</span>
    </a>
  </div>

  <div class="container">
    <div class="tab-container">
      <div class="tab active" onclick="changeTab('login')">Iniciar sesión</div>
      <div class="tab" onclick="changeTab('register')">Registrarse</div>
    </div>
    <div class="form-container">
      <div id="login-form" class="form active">
        <h2>Iniciar sesión</h2>
        <form>
          <div class="input-container">
            <label for="email">Correo electrónico</label>
            <input type="email" name="login-email" id="login-email" placeholder="ejemplo@dominio.com" required>
          </div>
          <div class="input-container">
            <label for="password">Contraseña</label>
            <input type="password" name="login-password" id="login-password" placeholder="********" required>
          </div>
          <button id="login-btn" type="button">Iniciar sesión</button>
        </form>
      </div>
      <div id="register-form" class="form">
        <h2>Registrarse</h2>
        <form>
          <div class="input-container">
            <label for="name">Nombre</label>
            <input type="text" name="register-name" id="register-name" placeholder="Nombre completo" required>
          </div>
          <div class="input-container">
            <label for="email">Correo electrónico</label>
            <input type="email" name="register-email" id="register-email" placeholder="ejemplo@dominio.com" required>
          </div>
          <div class="input-container">
            <label for="password">Contraseña</label>
            <input type="password" name="register-password" id="register-password" placeholder="********" required>
          </div>
          <button id="register-btn" type="button">Registrarse</button>
        </form>
      </div>
    </div>
  </div>

  <footer>
		<p>Derechos Reservados Restaurante Japonés Deli Tempura &copy; 2023</p>
	</footer>

  <script src="JS/login_register.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>