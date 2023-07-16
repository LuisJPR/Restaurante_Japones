<?php
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $direccion = $_POST["direccion"];

    // Obtener los datos de sesión activos
    $session_nomb = $_SESSION["nombre"];
    $session_email = $_SESSION["correo"];

    // Realizar las operaciones necesarias con los datos recibidos
    // Por ejemplo, guardarlos en la base de datos o realizar alguna otra acción
    include("conexion.php");
    $con = conexion();

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {

        // Verificar si existen coincidencias en la base de datos
        $coincidenciaNombre = false;
        $coincidenciaCorreo = false;
        findMatches($con, $nombre, $correo);

        // Si no hay coincidencias, actualizar la información en la base de datos
        if (!$coincidenciaNombre && !$coincidenciaCorreo) {
            $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', direccion = '$direccion'
            WHERE nombre = '$session_nomb' AND correo = '$session_email'";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                $response = [
                    "message" => "Error al actualizar los datos en el servidor."
                ];
            } else {
                // Actualizar los datos de sesión con los nuevos valores
                $_SESSION["nombre"] = $nombre;
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
        $response = [
            "message" => "Error en los datos enviados desde el cliente."
        ];
    }

    // Función para buscar coincidencias en la base de datos
    function findMatches($con, $session_nomb, $session_email) {
        $query = "SELECT correo, nombre FROM usuarios";
        $result = mysqli_query($con, $query);
        if (!$result) {
            die("Error al obtener los registros: " . mysqli_error($con));
        }

        // Verificar coincidencias de nombre y correo
        global $coincidenciaNombre, $coincidenciaCorreo;
        $coincidenciaNombre = false;
        $coincidenciaCorreo = false;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['nombre'] == $session_nomb) {
                $coincidenciaNombre = true;
            }

            if ($row['correo'] == $session_email) {
                $coincidenciaCorreo = true;
            }
        }
    }

    // Devolver una respuesta al cliente
    header("Content-Type: application/json");
    echo json_encode($response);
?>
