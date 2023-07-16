<?php
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $direccion = $_POST["direccion"];

    // Realizar las operaciones necesarias con los datos recibidos
    // Por ejemplo, guardarlos en la base de datos o realizar alguna otra acción
    include("conexion.php");
    $con = conexion();

    // Realizar las validaciones necesarias
    include("util.php");
    if (validarRegistroForm($nombre, $correo)) {
        $nomb = $_SESSION["nombre"];
        $email = $_SESSION["correo"];
        // Actualiza la informacion en la base de datos
        $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', clave = '$clave', direccion = '$direccion'
        WHERE nombre = '$nomb' AND correo ='$email'";
    }

    // Devolver una respuesta al cliente
    $response = [
        "message" => "--- Los datos se guardarobn correctamente en el servidor ---"
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
?>
