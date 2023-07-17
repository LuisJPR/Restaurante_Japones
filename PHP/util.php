<?php

    /* TEST */ 
    // Verifica si se ha enviado el formulario y si la acción es "logout"
    if (isset($_POST['action']) && $_POST['action'] === 'logout') {
        // Llama a la función logout()
        logout();
    }

    /**
     * Función para buscar coincidencias en la base de datos
     */
    function findMatches($con, $dato, $nomb_campo) {
        $query = "SELECT $nomb_campo FROM usuarios";
        $result = mysqli_query($con, $query);
        if (!$result) {
            $aux = mysqli_error($con);
            die("Error al obtener los registros de la base de datos: " . $aux);
        }

        // Verificar coincidencias del dato
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row[$nomb_campo] == $dato) {
                return true;
            }
        }
        return false;
    }

    /**
     * Cierra la sesión de usuario
     */
    function logout() {
        session_start();
        session_destroy();
        // Redireccionar a la página principal después de cerrar sesión
        header('Location: ../index.html'); 
        exit();
    }

    /**
     * Valida el ingreso correcto de datos para el registro
     */
    function validarRegistroForm($nombre, $correo) {
        if (validarNombre($nombre) && validarCorreo($correo)) {
            return true;
        }
        return false;
    }

    function validarNombre($nombre) {
        $tmp = trim($nombre);
        // Verificar si el nombre contiene solo letras utilizando una expresión regular
        if (!preg_match('/^[a-zA-Z]+$/', $tmp)) {
            return false;
        }
        return true;
    }

    function validarCorreo($correo) {
        $tmp = trim($correo);
        // Validar si el campo de correo electrónico es válido
        if (!filter_var($tmp, FILTER_VALIDATE_EMAIL)) {
            // El correo electrónico no es válido 
            return false;
        }
        return true;
    }

?>