<?php
require_once '../modelo/PacienteDAO.php';
require_once '../modelo/Paciente.php';

$dao = new PacienteDAO();

if ($_POST['accion'] == 'Registrar') {
    $p = new Paciente(
        $_POST['idpaciente'],
        $_POST['dni'],
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['email']
    );
    $dao->insertar($p);

} elseif ($_POST['accion'] == 'Actualizar') {
    $p = new Paciente(
        $_POST['idpaciente'],
        $_POST['dni'],
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['email']
    );
    $dao->actualizar($p);

} elseif ($_POST['accion'] == 'Eliminar') {
    $dao->eliminar($_POST['idpaciente']);
}

header("Location: ../vista/pacientes.php");
?>
