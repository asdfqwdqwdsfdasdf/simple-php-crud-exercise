<?php
require_once '../conexion/Conexion.php';

$idusuario = $_POST['idusuario'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$confirmar = $_POST['confirmar'];

if ($clave !== $confirmar) {
    echo "Las contraseñas no coinciden.<br>";
    echo '<a href="../vista/registro.php">Intentar de nuevo</a>';
    exit();
}

$hash = password_hash($clave, PASSWORD_DEFAULT);

try {
    $con = Conexion::conectar();
    $sql = "INSERT INTO usuarios (idusuario, usuario, clave) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$idusuario, $usuario, $hash]);
    echo "Usuario registrado con éxito.";
    echo '<br><a href="../vista/login.php">Iniciar sesión</a>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    echo '<br><a href="../vista/registro.php">Intentar de nuevo</a>';
}
?>