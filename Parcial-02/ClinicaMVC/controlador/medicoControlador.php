<?php
require_once '../modelo/MedicoDAO.php';
require_once '../modelo/Medico.php';

$dao = new MedicoDAO();

try {
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

    header("Location: ../vista/medicos.php?msg=success");
    exit();

} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Violación restricción de clave foránea
        $mensaje = "No se puede eliminar el médico porque tiene citas asignadas.";
    } else {
        $mensaje = "Error en la operación: " . $e->getMessage();
    }
    header("Location: ../vista/medicos.php?msg=error&detalle=" . urlencode($mensaje));
    exit();
}
