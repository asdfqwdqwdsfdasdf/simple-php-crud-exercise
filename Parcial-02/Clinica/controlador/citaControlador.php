<?php
require_once '../modelo/CitaDAO.php';
require_once '../modelo/Cita.php';

$dao = new CitaDAO();

try {
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

    header("Location: ../vista/citas.php?msg=success");
    exit();

} catch (PDOException $e) {
    // Verifica si es violación de clave única (duplicate entry)
    if ($e->getCode() === '23000') {
        $errorMsg = "Error: Ya existe una cita para el médico seleccionado en la fecha y hora indicadas.";
    } else {
        $errorMsg = "Error inesperado: " . $e->getMessage();
    }
    // Redirigir a la lista de citas con mensaje de error
    header("Location: ../vista/citas.php?error=" . urlencode($errorMsg));
    exit();
}
