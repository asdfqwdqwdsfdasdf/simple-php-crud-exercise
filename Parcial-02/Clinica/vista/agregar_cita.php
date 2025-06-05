<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/PacienteDAO.php';
require_once '../modelo/MedicoDAO.php';

$pacienteDAO = new PacienteDAO();
$medicoDAO = new MedicoDAO();

$pacientes = $pacienteDAO->listar();
$medicos = $medicoDAO->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Cita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script>
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('d-none');
    }
  </script>
</head>
<body class="bg-light">

  <!-- Navbar (igual que en otros archivos) -->
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
          <li class="nav-item"><a class="nav-link" href="medicos.php">Médicos</a></li>
          <li class="nav-item"><a class="nav-link active" href="citas.php">Citas</a></li>
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

  <div class="container mt-5">
    <h1 class="mb-4 text-primary">Agregar Cita</h1>

    <form action="../controlador/citaControlador.php" method="POST" class="needs-validation" novalidate>
      <input type="hidden" name="idcita" value="">

      <div class="mb-3">
        <label for="paciente_id" class="form-label">Paciente</label>
        <select name="paciente_id" id="paciente_id" class="form-select" required>
          <option value="">Seleccione un paciente</option>
          <?php foreach ($pacientes as $paciente): ?>
            <option value="<?php echo $paciente['idpaciente']; ?>">
              <?php echo htmlspecialchars($paciente['nombres'] . ' ' . $paciente['apellidos']); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor seleccione un paciente.</div>
      </div>

      <div class="mb-3">
        <label for="medico_id" class="form-label">Médico</label>
        <select name="medico_id" id="medico_id" class="form-select" required>
          <option value="">Seleccione un médico</option>
          <?php foreach ($medicos as $medico): ?>
            <option value="<?php echo $medico['idmedico']; ?>">
              <?php echo htmlspecialchars($medico['nombres'] . ' ' . $medico['apellidos']); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor seleccione un médico.</div>
      </div>

      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
        <div class="invalid-feedback">Por favor ingrese una fecha.</div>
      </div>

      <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" name="hora" id="hora" class="form-control" required>
        <div class="invalid-feedback">Por favor ingrese una hora.</div>
      </div>

      <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select" required>
          <option value="">Seleccione estado</option>
          <option value="Pendiente">Pendiente</option>
          <option value="Confirmada">Confirmada</option>
          <option value="Cancelada">Cancelada</option>
          <option value="Atendida">Atendida</option>
        </select>
        <div class="invalid-feedback">Por favor seleccione un estado.</div>
      </div>

      <input type="hidden" name="accion" value="Registrar">

      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="citas.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
