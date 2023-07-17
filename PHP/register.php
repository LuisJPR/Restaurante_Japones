<?php
    session_start(); // Iniciar la sesión

    // Valida si la sesión esta declarada y es diferente de null
    if (isset($_SESSION['formulario_enviado'])) {
        // El formulario ya se ha enviado, no se realiza ninguna acción adicional
        echo 'El formulario ya ha sido enviado. No se puede volver a enviar.';
        echo '<form action="util.php" method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Cerrar sesión">
      </form>';
        exit();
    }
    
    include("conexion.php");
    $con = conexion();

    // Obtener los datos del formulario
    $nombre = $_POST['register-name']; // +
    $correo = $_POST['register-email']; // +
    $clave = $_POST['register-password'];
    $direccion = "SIN ESPECIFICAR";

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {

        if (!findMatches($con, $correo, "correo")) {
            die('<script>
            window.alert("------- ATENCIÓN -------\nEl correo ingresado ya se encuentra registrado en el sistema. Verifique sus datos e intente de nuevo.");
            window.location.href = "../login_register.html";
            </script>');

        } else {
            $tmp = false;
            // Insertar los datos en la base de datos
            $sql = "INSERT INTO usuarios (nombre, correo, clave, direccion) VALUES ('$nombre','$correo', '$clave', '$direccion')";

            if ($con->query($sql) === TRUE) {
                echo "Datos guardados correctamente.";
                $_SESSION["nombre"] = $nombre;
                $_SESSION["correo"] = $correo;

                $_SESSION['formulario_enviado'] = true; // Marcar el formulario como enviado
                $tmp = true;
            } else {
                echo "Error al guardar los datos: " . $con->error;
            }

            // Cerrar la conexión con MySQL
            $con->close();
            echo "---- Sesión cerrada de MySQL ----";
            if ($tmp == true) {
                // Redireccionar a la página de perfil de usuario
                header('Location: ../user.html'); 
            }
        }
        
    } else {
        // Mostrar alerta JavaScript y recargar formulario
        echo '<script>
        window.alert("------- ATENCIÓN -------\nLos datos ingresados no son válidos. Se esperaba un nombre y un correo en sus formatos válidos.\n\nPor favor revise sus datos e intente de nuevo.");
        window.location.href = "../login_register.html";
        </script>';
    }

?>