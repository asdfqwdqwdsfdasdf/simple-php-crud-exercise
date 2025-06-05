<?php
require_once '../modelo/EspecialidadDAO.php';

// Validar que se envíe el ID de la especialidad para editar
if (!isset($_GET['idespecialidad'])) {
    header("Location: especialidades.php?msg=error&detalle=" . urlencode("ID de especialidad no especificado"));
    exit();
}

$idespecialidad = $_GET['idespecialidad'];
$dao = new EspecialidadDAO();
$especialidad = $dao->buscar($idespecialidad);

if (!$especialidad) {
    header("Location: especialidades.php?msg=error&detalle=" . urlencode("Especialidad no encontrada"));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Especialidad</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

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
        <li class="nav-item"><a class="nav-link" href="medicos.php">Médicos</a></li>
        <li class="nav-item"><a class="nav-link active" href="especialidades.php">Especialidades</a></li>
        <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
        <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
        <li class="nav-item"><a class="nav-link" href="../controlador/cerrarSesion.php">Cerrar sesión</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1 class="mb-4 text-primary">Editar Especialidad</h1>

  <form action="../controlador/especialidadControlador.php" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="accion" value="Actualizar" />
    <input type="hidden" name="idespecialidad" value="<?= htmlspecialchars($especialidad['idespecialidad']) ?>" />

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre de la Especialidad</label>
      <input type="text" id="nombre" name="nombre" class="form-control" required
             value="<?= htmlspecialchars($especialidad['nombre']) ?>" />
      <div class="invalid-feedback">Por favor ingrese el nombre de la especialidad.</div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Especialidad</button>
    <a href="especialidades.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', e => {
        if (!form.checkValidity()) {
          e.preventDefault()
          e.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

</body>
</html>
