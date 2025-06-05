<?php
require_once '../modelo/PacienteDAO.php';
require_once '../modelo/Paciente.php';

$dao = new PacienteDAO();

try {
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

    header("Location: ../vista/pacientes.php?msg=success");
    exit();

} catch (PDOException $e) {
    // Aquí puedes diferenciar errores por código SQLSTATE o errorCode
    if ($e->getCode() == 23000) { // Violación de restricción de clave foránea
        $mensaje = "No se puede eliminar el paciente porque tiene citas asignadas.";
    } else {
        $mensaje = "Error en la operación: " . $e->getMessage();
    }
    // Puedes enviar el error via GET para mostrarlo en la vista
    header("Location: ../vista/pacientes.php?msg=error&detalle=" . urlencode($mensaje));
    exit();
}
