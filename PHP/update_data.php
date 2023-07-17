<?php
    session_start(); // Inicia la sesion

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $direccion = $_POST["direccion"];

    // Obtener el dato de sesión activo
    $session_email = $_SESSION["correo"];

    // Realizar las operaciones necesarias con los datos recibidos
    // Por ejemplo, guardarlos en la base de datos
    include("conexion.php");
    $con = conexion();

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {

        // Verificar si existen coincidencias en la base de datos - [correo]
        $coincidenciaCorreo = findMatches($con, $correo, "correo");

        // Si no hay coincidencias, actualizar la información en la base de datos
        if (!$coincidenciaCorreo) {
            $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', direccion = '$direccion'
            WHERE correo = '$session_email'";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                $response = [
                    "message" => "Error al actualizar los datos en el servidor."
                ];
            } else {
                // Actualiza el dato de sesión
                $_SESSION["correo"] = $correo;

                $response = [
                    "message" => "Los datos se actualizaron correctamente en el servidor."
                ];
            }
        } else {
            $response = [
                "message" => "Ya existe una cuenta registrada en el sistema con los datos ingresados. Modifique su información e intente de nuevo."
            ];
        }
    } else {
        // Mostrar alerta JavaScript y recargar formulario
        echo '<script>
        window.alert("------- ATENCIÓN -------\nLos datos ingresados en el formulario de registro no son válidos.\n\nERROR: Nombre\nERROR: Correo electrónico\n\nRevise e intente de nuevo.");
        window.location.href = "../login_register.html";
        </script>';
        $response = [
            "message" => "Error en los datos enviados desde el cliente."
        ];
    }

    // Devolver una respuesta al cliente
    header("Content-Type: application/json");
    echo json_encode($response);
?>
