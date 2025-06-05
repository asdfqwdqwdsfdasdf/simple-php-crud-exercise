<?php
require_once '../modelo/MedicoDAO.php';
require_once '../modelo/Medico.php';

$dao = new MedicoDAO();

if ($_POST['accion'] == 'Registrar') {
    $m = new Medico(
        $_POST['idmedico'],
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['especialidad_id'],
        $_POST['telefono'],
        $_POST['email']
    );
    $dao->insertar($m);

} elseif ($_POST['accion'] == 'Actualizar') {
    $m = new Medico(
        $_POST['idmedico'],
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['especialidad_id'],
        $_POST['telefono'],
        $_POST['email']
    );
    $dao->actualizar($m);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idmedico']);
}

header("Location: ../vista/medicos.php");
?>
