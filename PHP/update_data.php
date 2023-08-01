<?php
    session_start(); // Inicia la sesion

    // Recibir los datos JSON enviados desde JavaScript
    $data = json_decode(file_get_contents('php://input'), true);

    // Obtener los datos enviados desde JSON en JavaScript
    $nombre = $data["nombre"];
    $correo = $data["correo"];
    $clave = $data["clave"];
    $direccion = $data["direccion"];

    // Obtener el dato de sesión activo
    $usuario = $_SESSION["usuario"];

    include("conexion.php");
    $con = conexion();

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {
        // Verificar si existen coincidencias en la base de datos - [correo]
        $coincidenciaCorreo = findMatches($con, $correo, "correo");

        // Si no hay coincidencias, actualizar la información en la base de datos
        if (!$coincidenciaCorreo) {
            $data_sesion = $usuario['correo'];

            $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', direccion = '$direccion'
            WHERE correo = '$data_sesion'";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo json_encode(array("error" => "Error al actualizar los datos en el servidor."));
                exit();

            } else {
                // Consulta SQL para verificar el usuario y obtener todos sus datos
                $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
                $res = $con->query($sql);

                // Verificar si se encontró un usuario con los datos ingresados
                if ($res->num_rows == 1) {
                    // Usuario válido, obtener los datos del usuario
                    $usuario = $res->fetch_assoc();
                    // Cerrar la conexión a la base de datos
                    $con->close();
                    // Actualiza los datos del usuario en la variable de sesión
                    $_SESSION['usuario'] = $usuario;
                    // Redireccionar a otra página HTML
                    
                }

                header("Location: ../user.php");
                exit();
            }
        } else {
            echo json_encode(array("error" => "Ya existe una cuenta registrada en el sistema con el correo ingresado. Modifique su información e intente de nuevo."));
        }

    } else {
        // Mostrar alerta JavaScript y recargar formulario
        echo json_encode(array("error" => "Los datos ingresados no son correctos. Se esperaba un nombre y un correo en sus formatos válidos. Por favor revise sus datos e intente de nuevo."));
    }

?>
