<?php
    
    /**
     * Realiza la conexion a la base de datos. Devuelve una instancia de la misma.
     */
    function conexion() {
        // Establecer la conexión con la base de datos MySQL
        $servername = "127.0.0.1:3307";
        $username = "root";
        $password = "";
        $dbname = "web_delitempura";

        $con = new mysqli($servername, $username, $password, $dbname);
        if ($con->connect_error) {
            die("Error al conectar a la base de datos: " . $con->connect_error);
        } else {
            //echo "Conexión Exitosa !". "<br>";
        }

        return $con;
    }

?>