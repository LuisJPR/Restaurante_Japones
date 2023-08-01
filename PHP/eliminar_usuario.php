<?php
    // Verificar si el usuario está autenticado
    session_start();
    
    if (!isset($_SESSION['usuario'])) {
        // Redireccionar al usuario si no está autenticado
        header("Location: ../index.html");
        exit();
    }

        include("conexion.php");
        $con = conexion();

        // Obtener el usuario logeado de la variable de sesión
        $usuario = $_SESSION['usuario']['nombre'];

        // Preparar la consulta para eliminar los datos del usuario
        $sql = "DELETE FROM usuarios WHERE nombre = '$usuario'";

        if ($con->query($sql) === TRUE) {
            // Éxito al eliminar los datos, cerrar la sesión y redirigir al usuario a index.html
            session_destroy();
            header("Location: ../index.html");
            exit();
            
        } else {
            die("Error al eliminar la cuenta: " . $con->error);
        }

        // Cerrar la conexión a la base de datos
        $con->close();
    
?>
