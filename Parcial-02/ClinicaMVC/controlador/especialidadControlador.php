<?php
require_once '../modelo/EspecialidadDAO.php';
require_once '../modelo/Especialidad.php';

$dao = new EspecialidadDAO();

if ($_POST['accion'] == 'Registrar') {
    $e = new Especialidad(
        $_POST['idespecialidad'],
        $_POST['nombre']
    );
    $dao->insertar($e);

} elseif ($_POST['accion'] == 'Actualizar') {
    $e = new Especialidad(
        $_POST['idespecialidad'],
        $_POST['nombre']
    );
    $dao->actualizar($e);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idespecialidad']);
}

header("Location: ../vista/especialidades.php");
?>
