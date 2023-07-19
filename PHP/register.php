<?php
    session_start(); // Iniciar la sesión

    // Recibir los datos JSON enviados desde JavaScript
    $data = json_decode(file_get_contents('php://input'), true);

    include("conexion.php");
    $con = conexion();

    // Obtener los datos del formulario via JSON
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $clave = $data['clave'];
    $direccion = "SIN ESPECIFICAR";

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {
        if (findMatches($con, $correo, "correo")) {
            echo json_encode(array('error' => 'El correo ingresado ya se encuentra registrado en el sistema. Verifique sus datos e intente de nuevo.'));
            exit();

        } else {
            // Insertar los datos en la base de datos
            $sql = "INSERT INTO usuarios (nombre, correo, clave, direccion) VALUES ('$nombre','$correo', '$clave', '$direccion')";

            if ($con->query($sql) === TRUE) {
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
                }

            } else {
                echo json_encode(array('error' => 'Error al guardar los datos: '. $con->error));
                exit();
            }
        }
        
    } else {
        echo json_encode(array('error' => 'Los datos ingresados no son correctos. Se esperaba un nombre y un correo en sus formatos válidos. Por favor revise sus datos e intente de nuevo.'));        
        exit();
    }

?>