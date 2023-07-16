<?php

    /* TEST */ 
    // Verifica si se ha enviado el formulario y si la acción es "logout"
    if (isset($_POST['action']) && $_POST['action'] === 'logout') {
        // Llama a la función logout()
        logout();
    }

    function logout() {
        session_start();
        session_destroy();
        // Redireccionar a la página principal después de cerrar sesión
        header('Location: ../index.html'); 
        exit();
    }

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