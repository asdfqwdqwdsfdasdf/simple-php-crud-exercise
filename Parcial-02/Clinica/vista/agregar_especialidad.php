<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Especialidad</title>
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
          <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
          <li class="nav-item"><a class="nav-link active" href="especialidades.php">Especialidades</a></li>
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
    <h1 class="mb-4 text-primary">Agregar Nueva Especialidad</h1>

    <form action="../controlador/especialidadControlador.php" method="POST" class="bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
      <div class="mb-3">
        <label for="idespecialidad" class="form-label">ID de Especialidad</label>
        <input type="text" class="form-control" id="idespecialidad" name="idespecialidad" required maxlength="10" />
      </div>
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de Especialidad</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100" />
      </div>

      <input type="hidden" name="accion" value="Registrar" />
      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="especialidades.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
