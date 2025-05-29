<!DOCTYPE html>
<html>
<head><title>Login con MySQL</title></head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="../controlador/validar.php" method="post">
        Usuario: <input type="text" name="usuario"><br>
        Clave: <input type="password" name="clave"><br>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>