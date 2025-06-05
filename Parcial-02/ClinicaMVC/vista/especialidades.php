<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/EspecialidadDAO.php';
$dao = new EspecialidadDAO();
$especialidades = $dao->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lista de Especialidades</title>
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
          <li class="nav-item"><a class="nav-link" href="medicos.php">Medicos</a></li>
          <li class="nav-item"><a class="nav-link" href="especialidades.php">Especialidades</a></li>

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
      <a href="especialidades.php" class="d-block text-white mb-2">Especialidades</a>
      <a href="../controlador/cerrarSesion.php" class="d-block text-white">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="container mt-5">
    <h1 class="mb-4 text-primary">Lista de Especialidades</h1>

    <a href="agregar_especialidad.php" class="btn btn-primary mb-4">Agregar Especialidad</a>

    <?php if (!empty($especialidades)): ?>
    <table class="table table-striped table-bordered">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($especialidades as $e): ?>
        <tr>
          <td><?= htmlspecialchars($e['idespecialidad']) ?></td>
          <td><?= htmlspecialchars($e['nombre']) ?></td>
          <td>
            <a href="editar_especialidad.php?idespecialidad=<?= urlencode($e['idespecialidad']) ?>" class="btn btn-sm btn-warning">Editar</a>

            <form action="../controlador/especialidadControlador.php" method="POST" style="display:inline-block;">
              <input type="hidden" name="idespecialidad" value="<?= htmlspecialchars($e['idespecialidad']) ?>">
              <input type="hidden" name="accion" value="Eliminar">
              <button type="submit" onclick="return confirm('¿Está seguro de eliminar esta especialidad?');" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p class="text-danger">No hay especialidades registradas.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
