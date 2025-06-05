<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/CitaDAO.php';
require_once '../modelo/PacienteDAO.php';
require_once '../modelo/MedicoDAO.php';

$daoCita = new CitaDAO();
$daoPaciente = new PacienteDAO();
$daoMedico = new MedicoDAO();

if (!isset($_GET['idcita'])) {
    header("Location: citas.php");
    exit();
}

$idcita = $_GET['idcita'];
$cita = $daoCita->buscar($idcita);
if (!$cita) {
    header("Location: citas.php");
    exit();
}

$pacientes = $daoPaciente->listar();
$medicos = $daoMedico->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Cita</title>
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
          <li class="nav-item"><a class="nav-link" href="medicos.php">Médicos</a></li>
          <li class="nav-item"><a class="nav-link" href="especialidades.php">Especialidades</a></li>
          <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
          <li class="nav-item"><a class="nav-link active" href="citas.php">Editar Cita</a></li>
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
      <a href="especialidades.php" class="d-block text-white mb-2">Especialidades</a>
      <a href="citas.php" class="d-block text-white mb-2">Citas</a>
      <a href="../controlador/cerrarSesion.php" class="d-block text-white">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="container mt-5">

    <h1 class="mb-4 text-primary">Editar Cita</h1>

    <form action="../controlador/citaControlador.php" method="POST">
      <input type="hidden" name="idcita" value="<?php echo htmlspecialchars($cita['idcita']); ?>">

      <div class="mb-3">
        <label for="paciente_id" class="form-label">Paciente</label>
        <select name="paciente_id" id="paciente_id" class="form-select" required>
          <option value="" disabled>Seleccione un paciente</option>
          <?php foreach ($pacientes as $paciente): ?>
            <option value="<?php echo $paciente['idpaciente']; ?>"
              <?php if ($paciente['idpaciente'] == $cita['paciente_id']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($paciente['nombres'] . ' ' . $paciente['apellidos']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="medico_id" class="form-label">Médico</label>
        <select name="medico_id" id="medico_id" class="form-select" required>
          <option value="" disabled>Seleccione un médico</option>
          <?php foreach ($medicos as $medico): ?>
            <option value="<?php echo $medico['idmedico']; ?>"
              <?php if ($medico['idmedico'] == $cita['medico_id']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($medico['nombres'] . ' ' . $medico['apellidos']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" id="fecha" name="fecha" class="form-control" required
               value="<?php echo htmlspecialchars($cita['fecha']); ?>">
      </div>

      <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" id="hora" name="hora" class="form-control" required
               value="<?php echo htmlspecialchars($cita['hora']); ?>">
      </div>

      <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select" required>
          <?php
          $estados = ['pendiente', 'atendida', 'cancelada'];
          foreach ($estados as $estado):
          ?>
            <option value="<?php echo $estado; ?>" <?php if ($cita['estado'] == $estado) echo 'selected'; ?>>
              <?php echo ucfirst($estado); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <input type="hidden" name="accion" value="Actualizar">

      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      <a href="citas.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
