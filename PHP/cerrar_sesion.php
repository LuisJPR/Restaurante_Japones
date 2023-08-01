<?php
    /**
     * Cierra la sesión de usuario
     */
    session_start();
    session_destroy();

    // Redireccionar a la página principal después de cerrar sesión
    header('Location: ../index.html'); 
    exit();
?>