<!DOCTYPE html>
<html>
<head><title>Login con MySQL</title>

<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="../controlador/loginControlador.php" method="post">
        Usuario: <input type="text" name="usuario"><br>
        Clave: <input type="password" name="clave"><br>
        <input type="submit" value="Ingresar">
        <a href="http://localhost:8088/simple-php-crud-exercise/ejercicio-login/vistas/registro.php" class="button-Register">Registrarse</a>

    </form>
</body>
</html>