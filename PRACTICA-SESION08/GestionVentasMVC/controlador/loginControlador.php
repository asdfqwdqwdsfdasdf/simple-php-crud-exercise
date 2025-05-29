<?php
session_start();
require_once '../conexion/Conexion.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$con = Conexion::conectar();
$sql = "SELECT * FROM usuario WHERE usuario = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$usuario]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($clave, $user['clave'])) {
    $_SESSION['usuario'] = $usuario;
    header("Location: ../vista/bienvenida.php");
} else {
    echo "Usuario o contraseña incorrectos.";
    echo '<br><a href="../vista/login.php">Intentar de nuevo</a>';
}
?>