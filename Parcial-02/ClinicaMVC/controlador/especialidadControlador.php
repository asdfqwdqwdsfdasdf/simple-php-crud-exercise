<?php
require_once '../modelo/EspecialidadDAO.php';
require_once '../modelo/Especialidad.php';

$dao = new EspecialidadDAO();

try {
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

    header("Location: ../vista/especialidades.php?msg=success");
    exit();

} catch (PDOException $e) {
    // Detectar error de restricción FK (código 23000)
    if ($e->getCode() == 23000) {
        $mensaje = "No se puede eliminar la especialidad porque está asignada a uno o más médicos.";
    } else {
        $mensaje = "Error en la operación: " . $e->getMessage();
    }

    // Redirigir con mensaje de error
    header("Location: ../vista/especialidades.php?msg=error&detalle=" . urlencode($mensaje));
    exit();
}
?>
