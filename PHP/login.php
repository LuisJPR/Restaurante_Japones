<?php
    include("conexion.php");
    $con=conexion();
    
    // Obtener los datos del formulario " LOGIN "
    $correo = $_POST['login-email'];
    $clave = $_POST['login-password'];

    // Realizar las validaciones necesarias
    // ...
    
    // Cerrar la conexión
    $con->close();

?>