<?php
require_once '../modelo/MedicoDAO.php';

// Validar que se envíe el ID del médico para editar
if (!isset($_GET['idmedico'])) {
    header("Location: medicos.php?msg=error&detalle=" . urlencode("ID de médico no especificado"));
    exit();
}

$idmedico = $_GET['idmedico'];
$dao = new MedicoDAO();
$medico = $dao->buscar($idmedico);

if (!$medico) {
    header("Location: medicos.php?msg=error&detalle=" . urlencode("Médico no encontrado"));
    exit();
}

// Traer también las especialidades para mostrar en el select
require_once '../modelo/EspecialidadDAO.php';
$especialidadDAO = new EspecialidadDAO();
$especialidades = $especialidadDAO->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand" href="bienvenida.php">GestionVentas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="bienvenida.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="pacientes.php">Pacientes</a></li>
                <li class="nav-item"><a class="nav-link active" href="medicos.php">Médicos</a></li>
                <li class="nav-item"><a class="nav-link" href="especialidades.php">Especialidades</a></li>
                <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
                <li class="nav-item"><a class="nav-link" href="../controlador/cerrarSesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container mt-5">

    <h1 class="mb-4 text-primary">Editar Médico</h1>

    <form action="../controlador/medicoControlador.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="accion" value="Actualizar" />
        <input type="hidden" name="idmedico" value="<?= htmlspecialchars($medico['idmedico']) ?>" />

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" required
                   value="<?= htmlspecialchars($medico['nombres']) ?>" />
            <div class="invalid-feedback">Por favor ingrese los nombres.</div>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" required
                   value="<?= htmlspecialchars($medico['apellidos']) ?>" />
            <div class="invalid-feedback">Por favor ingrese los apellidos.</div>
        </div>

        <div class="mb-3">
            <label for="especialidad_id" class="form-label">Especialidad</label>
            <select id="especialidad_id" name="especialidad_id" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php foreach ($especialidades as $esp): ?>
                    <option value="<?= $esp['idespecialidad'] ?>"
                        <?= $esp['idespecialidad'] == $medico['especialidad_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($esp['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione una especialidad.</div>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control"
                   value="<?= htmlspecialchars($medico['telefono']) ?>" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($medico['email']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Médico</button>
        <a href="medicos.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Ejemplo básico para validación de formulario Bootstrap 5
(() => {
  'use strict'

  // Obtener todos los formularios que requieren validación
  const forms = document.querySelectorAll('.needs-validation')

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

</body>
</html>
