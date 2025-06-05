<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/EspecialidadDAO.php';
$especialidadDAO = new EspecialidadDAO();
$especialidades = $especialidadDAO->listar();  // Traemos las especialidades para el select
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Médico</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script>
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('d-none');
    }
  </script>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow">
    <div class="container">
      <a class="navbar-brand" href="bienvenida.php">GestionVentas</a>
      <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-none d-md-flex" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="bienvenida.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="pacientes.php">Pacientes</a></li>
          <li class="nav-item"><a class="nav-link active" href="medicos.php">Médicos</a></li>
          <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
          <li class="nav-item"><a class="nav-link" href="../controlador/cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Menú móvil -->
  <div id="mobile-menu" class="d-md-none d-none bg-primary">
    <div class="container py-3">
      <a href="bienvenida.php" class="d-block text-white mb-2">Inicio</a>
      <a href="pacientes.php" class="d-block text-white mb-2">Pacientes</a>
      <a href="medicos.php" class="d-block text-white mb-2">Médicos</a>
      <a href="citas.php" class="d-block text-white mb-2">Citas</a>
      <a href="historiales.php" class="d-block text-white mb-2">Historiales</a>
      <a href="../controlador/cerrarSesion.php" class="d-block text-white">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="container mt-5">
    <h1 class="mb-4 text-primary">Agregar Médico</h1>

    <form action="../controlador/medicoControlador.php" method="POST" class="needs-validation" novalidate>
      <!-- Campo oculto para idmedico, dejar vacío para que se genere automático si aplicas -->
      <input type="hidden" name="idmedico" value="">

      <div class="mb-3">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nombres" name="nombres" required>
        <div class="invalid-feedback">Por favor ingresa los nombres.</div>
      </div>

      <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        <div class="invalid-feedback">Por favor ingresa los apellidos.</div>
      </div>

      <div class="mb-3">
        <label for="especialidad_id" class="form-label">Especialidad</label>
        <select class="form-select" id="especialidad_id" name="especialidad_id" required>
          <option value="" selected disabled>Seleccione una especialidad</option>
          <?php foreach ($especialidades as $esp): ?>
            <option value="<?php echo htmlspecialchars($esp['idespecialidad']); ?>">
              <?php echo htmlspecialchars($esp['nombre']); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor selecciona una especialidad.</div>
      </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" required pattern="[0-9]{7,15}">
        <div class="invalid-feedback">Por favor ingresa un teléfono válido.</div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">Por favor ingresa un correo electrónico válido.</div>
      </div>

      <input type="hidden" name="accion" value="Registrar">

      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="medicos.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Bootstrap validation
    (() => {
      'use strict'
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
