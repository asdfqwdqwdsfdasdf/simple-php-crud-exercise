<?php
 // Inicia la sesión o continúa la sesión actual.
session_start();
// Elimina todos los datos de la sesión activa.
session_destroy(); 
 // Redirige al usuario a la página de login.
 // utiliza la cabecera http "header" junto a Location y la ruta del archivo para redirigir
header("Location: ../vista/login.php");

?>