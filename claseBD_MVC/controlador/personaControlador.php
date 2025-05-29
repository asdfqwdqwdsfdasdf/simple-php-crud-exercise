<?php
require_once '../modelo/PersonaDAO.php';
require_once '../modelo/Persona.php';

$dao = new PersonaDAO();
if ($_POST['accion'] == 'Registrar') {
    $p = new Persona($_POST['idpersona'], $_POST['apellidos'], $_POST['nombres'],
        $_POST['fechaNacimiento'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);
    $dao->insertar($p);
} elseif ($_POST['accion'] == 'Actualizar') {
    $p = new Persona($_POST['idpersona'], $_POST['apellidos'], $_POST['nombres'],
        $_POST['fechaNacimiento'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);
    $dao->actualizar($p);
}
header("Location: ../vista/personas.php");
?>