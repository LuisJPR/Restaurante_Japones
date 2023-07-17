<?php
    session_start(); // Iniciar la sesión

    include("conexion.php");
    $con = conexion();
    
    // Obtener los datos del formulario
    $correo = $_POST['login-email'];
    $clave = $_POST['login-password'];

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarCorreo($correo)) {
        // Consulta SQL para verificar el usuario y obtener todos sus datos
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
        $result = $con->query($sql);

        // Verificar si se encontró un usuario con los datos ingresados
        if ($result->num_rows == 1) {
            // Usuario válido, obtener los datos del usuario
            $usuario = $result->fetch_assoc();

            // Crear un objeto JSON con los datos del usuario
            $usuarioJson = json_encode($usuario);

            // Enviar la respuesta al archivo JavaScript
            echo $usuarioJson;

            // Redireccionar a otra página HTML
            header("Location: ../user.html");
            exit();
        } else {
            // Usuario inválido, mostrar mensaje de error y redirigir al formulario de login
            echo '<script>
            windows.alert("Correo o clave incorrectos");
            windows.location("../login_register.html");
            </script>';
        }

        // Cerrar la conexión a la base de datos
        $con->close();
    }

?>