<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        http_response_code(404);
        include('404.html');
        exit();
    }

    // Obtener los datos del usuario de la variable de sesión
    $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="IMG/restaurant.ico">
    <title>Perfil de Usuario | Restaurante</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@700&family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/normalize.css">
    <link rel="stylesheet" href="CSS/estilos.css">
    <link rel="stylesheet" type="text/css" href="CSS/user.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <!-- Encabezado -->
    <header class="encabezado">
        <div class="contenedor-navegacion">
            <div class="contenido-navegacion contenedor">
                <div class="logo">
                    <h2 id="inicio-e" class="eslogan">Deli Tempura</h2>
                </div>
                <div class="menuP">
                    <input type="checkbox" id="menuO" />
                    <label for="menuO" onclick="togglenav()"><img data-src="IMG/menu.svg" alt="menu-icono" class="menu-icono"></label>
                </div>
                <nav class="navegacion">
                    <a href="index.html" class="nav-tab">Inicio</a>
                    <a href="index.html#nosotros-e" class="nav-tab">Nosotros</a>
                    <a href="index.html#menu-e" class="nav-tab">Menú</a>
                    <a href="index.html#mision-e" class="nav-tab">Mision y Vision</a>
                    <a href="index.html#contacto-e" class="nav-tab">Contacto</a>
                    <a href="login_register.html" class="cuenta-link">
                      <span class="icono-user">
                        <img data-src="IMG/user-regular.svg" alt="Icono Usuario">
                      </span>Ingresar</a>
                </nav>                  
                <!-- CARRITO -->
                <div>
                    <ul>
                        <li class="submenu">
                            <img data-src="IMG/carrito.svg" alt="carrito" id="img-carrito" style="width: 40px;">
                            <div id="carrito">
                                <table id="lista-carrito">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <a href="#" id="vaciar-carrito" class="btn-2">Vaciar Carrito</a>
                                <a href="#" id="procesar-compra" class="btn-2">Procesar Compra</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
                <!-- FIN-CARRITO -->
            </div>
        </div>
        <!-- Menu responsive -->
        <nav id="navmovil">
            <li><a href="index.html" onclick="togglenav()">Inicio</a></li>
            <li><a href="index.html#nosotros-e" onclick="togglenav()">Nosotros</a></li>
            <li><a href="index.html#menu-e" onclick="togglenav()">Menú</a></li>
            <li><a href="index.html#mision-e" onclick="togglenav()">Mision y Vision</a></li>
            <li><a href="index.html#contacto-e" onclick="togglenav()">Contacto</a></li>
            <li><a href="login_register.html" onclick="togglenav()" class="ingresar-link">
                <span class="icon-responsive">
                  <img data-src="IMG/user-regular.svg" alt="Icono Usuario">
                </span>Ingresar</a></li>
        </nav>
    </header>

    <!-- PERFIL DE USUARIO -->
    <div class="container">
        <h1>Bienvenid@ a tu perfil <?php echo $usuario['nombre'] ?></h1>
        <div class="profile">
          <img data-src="IMG/user-regular.svg" alt="Imagen de Usuario" class="profile-image">
          <div class="profile-info">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?php echo $usuario['nombre'] ?>" placeholder="Nombre" readonly>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['correo'] ?>" placeholder="Email" readonly>
    
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" value="<?php echo $usuario['clave'] ?>" placeholder="Contraseña" readonly>
    
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" value="<?php echo $usuario['direccion'] ?>" placeholder="Dirección" readonly>
          </div>
        </div>
    
        <div class="buttons">
          <button id="modify-btn">Modificar Datos</button>
          <button id="save-btn" disabled>Guardar Cambios</button>
          <button id="logout-btn">Cerrar Sesión</button>
          <button id="delete-btn">Eliminar Cuenta</button>
        </div>
      </div>    

    <!-- PIE DE PAGINA -->
    <div class="pie-pagina">
        <div class="contenedor-piepagina contenedor">
            <div class="info">
                <h3>Direccion</h3>
                <p>Av. Aviacion, San Borja 1234</p>
            </div>
            <div class="info">
                <h3>Horario de atencion</h3>
                <p>
                    Lunes a Viernes, 11am a 10pm <br>
                    Sabados y Domingos, 12pm a 10pm
                </p>
            </div>
            <div class="info">
                <h3>Siguenos en</h3>
                <div class="redes-sociales redes-pie">
                    <a href="https://es-la.facebook.com/" target="_blank"><img data-src="IMG/icoB-facebook.svg" alt="facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img data-src="IMG/icoB-instagram.svg" alt="instagram"></a>
                    <a href="https://www.tiktok.com/es/" target="_blank"><img data-src="IMG/icoB-tiktok.svg" alt="tiktok"></a>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados &copy; 2023 Deli Tempura</p>
    </footer>

    <script src="JS/app.js"></script>
    <script src="JS/user.js"></script>
</body>
</html>

