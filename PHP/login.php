<?php
    session_start(); // Iniciar la sesión

    // Recibir los datos JSON enviados desde JavaScript
    $data = json_decode(file_get_contents('php://input'), true);

    include("conexion.php");
    $con = conexion();
    
    // Obtener los datos del formulario via JSON
    $correo = $data['correo'];
    $clave = $data['clave'];

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

                // Cerrar la conexión a la base de datos
                $con->close();

                // Guardar los datos del usuario en una variable de sesión
                $_SESSION['usuario'] = $usuario;

                // Redireccionar a otra página HTML
                header("Location: ../user.php");
                exit();
            } else {
                // Usuario inválido, mostrar mensaje de error y redirigir al formulario de login
                echo json_encode(array('error' => 'Correo o clave incorrectos. Revise e intente de nuevo.'));
                exit();
            }
        } else {
            echo json_encode(array('error' => 'El correo ingresado no es valido. Verifique sus datos e intente de nuevo.'));
            exit();
        }

?>