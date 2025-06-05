<?php
require_once '../modelo/UsuarioDAO.php';
require_once '../modelo/Usuario.php';

$dao = new UsuarioDAO();

if ($_POST['accion'] == 'Registrar') {
    $u = new Usuario(
        $_POST['idusuario'],
        $_POST['usuario'],
        $_POST['clave'] // Se recomienda encriptar la clave antes de guardar
    );
    $dao->insertar($u);

} elseif ($_POST['accion'] == 'Actualizar') {
    $u = new Usuario(
        $_POST['idusuario'],
        $_POST['usuario'],
        $_POST['clave'] // Encriptar si aplica
    );
    $dao->actualizar($u);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idusuario']);
}

header("Location: ../vista/usuarios.php");
?>
