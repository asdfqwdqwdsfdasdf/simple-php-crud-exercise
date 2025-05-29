
<?php
 // Inicia la sesión o continúa la sesión actual.
session_start();
// si no existe $_SESSION, entonces redirigir a login.php
// la redireccion es manejada agregando el header http "Location" y asignandole login.php
// $_SESSION :  es una variable del lado servidor en PHP.
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    //finalizar
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Bienvenido</title></head>
<body>
    <h1>Hola, <?php echo $_SESSION['usuario']; ?>!</h1>
    <a href="../controlador/cerrar.php">Cerrar sesión</a>
</body>
</html>