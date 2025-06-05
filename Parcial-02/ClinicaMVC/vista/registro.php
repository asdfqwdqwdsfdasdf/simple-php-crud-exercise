<!DOCTYPE html>
<html>
<head><title>Registro de Usuario</title></head>
<body>
    <h2>Registrar Nuevo Usuario</h2>
    <form action="../controlador/registrar.php" method="post">
        ID Usuario: <input type="text" name="idusuario"><br>
        Usuario: <input type="text" name="usuario"><br>
        Clave: <input type="password" name="clave"><br>
        Confirmar Clave: <input type="password" name="confirmar"><br>
        <input type="submit" value="Registrar">
    </form>
    <br><a href="login.php">Volver al Login</a>
</body>
</html>