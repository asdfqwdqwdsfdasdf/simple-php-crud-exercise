<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../modelo/PacienteDAO.php';

$dao = new PacienteDAO();

$idpaciente = $_GET['idpaciente'] ?? null;

if (!$idpaciente) {
    header("Location: pacientes.php");
    exit();
}

$paciente = $dao->buscar($idpaciente);

if (!$paciente) {
    echo "Paciente no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Paciente</title>
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
      <a href="productos.php" class="d-block text-white mb-2">Productos</a>
      <a href="clientes.php" class="d-block text-white mb-2">Clientes</a>
      <a href="pedidos.php" class="d-block text-white mb-2">Pedidos</a>
      <a href="../controlador/cerrarSesion.php" class="d-block text-white">Cerrar sesión</a>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="container mt-5">

    <h1 class="mb-4 text-primary">Editar Paciente</h1>

    <form action="../controlador/pacienteControlador.php" method="post" class="needs-validation" novalidate>
      <input type="hidden" name="accion" value="Actualizar" />
      <input type="hidden" name="idpaciente" value="<?= htmlspecialchars($paciente['idpaciente']) ?>" />

      <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" class="form-control" id="dni" name="dni" required value="<?= htmlspecialchars($paciente['dni']) ?>" />
        <div class="invalid-feedback">Por favor ingresa el DNI.</div>
      </div>

      <div class="mb-3">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nombres" name="nombres" required value="<?= htmlspecialchars($paciente['nombres']) ?>" />
        <div class="invalid-feedback">Por favor ingresa los nombres.</div>
      </div>

      <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required value="<?= htmlspecialchars($paciente['apellidos']) ?>" />
        <div class="invalid-feedback">Por favor ingresa los apellidos.</div>
      </div>

      <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required value="<?= htmlspecialchars($paciente['direccion']) ?>" />
        <div class="invalid-feedback">Por favor ingresa la dirección.</div>
      </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required value="<?= htmlspecialchars($paciente['telefono']) ?>" />
        <div class="invalid-feedback">Por favor ingresa el teléfono.</div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($paciente['email']) ?>" />
        <div class="invalid-feedback">Por favor ingresa un email válido.</div>
      </div>

      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="pacientes.php" class="btn btn-secondary">Cancelar</a>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Bootstrap validation example
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
