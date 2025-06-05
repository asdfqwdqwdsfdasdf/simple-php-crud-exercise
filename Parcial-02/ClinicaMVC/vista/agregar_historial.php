<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/CitaDAO.php';
$citaDAO = new CitaDAO();

// Traemos solo citas que están "atendida" para poder generar el historial
$citasAtendidas = $citaDAO->listar();
$citasDisponibles = array_filter($citasAtendidas, function($cita) {
    return strtolower($cita['estado']) === 'atendida';
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Historial Clínico</title>
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
          <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
          <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
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
      <a href="historiales.php" class="d-block text-white mb-2">Historiales</a>
      <a href="citas.php" class="d-block text-white mb-2">Citas</a>
      <a href="../controlador/cerrarSesion.php" class="d-block text-white">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="container mt-5">

    <h1 class="mb-4 text-primary">Agregar Historial Clínico</h1>

    <form action="../controlador/historialControlador.php" method="POST">

      <input type="hidden" name="idhistorial" value="">

      <div class="mb-3">
        <label for="cita_id" class="form-label">Cita (solo citas atendidas)</label>
        <select class="form-select" id="cita_id" name="cita_id" required>
          <option value="" disabled selected>Seleccione una cita</option>
          <?php foreach ($citasDisponibles as $cita): ?>
            <option value="<?php echo htmlspecialchars($cita['idcita']); ?>">
              <?php 
                echo "ID: " . $cita['idcita'] . " | Fecha: " . $cita['fecha'] . " " . $cita['hora']; 
              ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="diagnostico" class="form-label">Diagnóstico</label>
        <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3" required></textarea>
      </div>

      <div class="mb-3">
        <label for="tratamiento" class="form-label">Tratamiento</label>
        <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3" required></textarea>
      </div>

      <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
      </div>

      <input type="hidden" name="accion" value="Registrar">

      <button type="submit" class="btn btn-primary">Registrar Historial</button>
      <a href="historiales.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
