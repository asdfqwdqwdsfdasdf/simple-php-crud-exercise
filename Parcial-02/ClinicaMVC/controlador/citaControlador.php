<?php
require_once '../modelo/CitaDAO.php';
require_once '../modelo/Cita.php';

$dao = new CitaDAO();

if ($_POST['accion'] == 'Registrar') {
    $c = new Cita(
        $_POST['idcita'], 
        $_POST['paciente_id'], 
        $_POST['medico_id'], 
        $_POST['fecha'], 
        $_POST['hora'], 
        $_POST['estado']
    );
    $dao->insertar($c);

} elseif ($_POST['accion'] == 'Actualizar') {
    $c = new Cita(
        $_POST['idcita'], 
        $_POST['paciente_id'], 
        $_POST['medico_id'], 
        $_POST['fecha'], 
        $_POST['hora'], 
        $_POST['estado']
    );
    $dao->actualizar($c);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idcita']);
}

header("Location: ../vista/citas.php");
?>
