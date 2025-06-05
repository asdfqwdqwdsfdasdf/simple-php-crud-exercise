<?php
require_once '../modelo/HistorialDAO.php';
require_once '../modelo/Historial.php';

$dao = new HistorialDAO();

if ($_POST['accion'] == 'Registrar') {
    $h = new Historial(
        $_POST['idhistorial'],
        $_POST['cita_id'],
        $_POST['diagnostico'],
        $_POST['tratamiento'],
        $_POST['observaciones']
    );
    $dao->insertar($h);

} elseif ($_POST['accion'] == 'Actualizar') {
    $h = new Historial(
        $_POST['idhistorial'],
        $_POST['cita_id'],
        $_POST['diagnostico'],
        $_POST['tratamiento'],
        $_POST['observaciones']
    );
    $dao->actualizar($h);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idhistorial']);
}

header("Location: ../vista/historiales.php");
?>
