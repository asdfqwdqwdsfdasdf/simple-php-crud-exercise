<?php
session_start();

// Tiempo máximo de inactividad en segundos (5 minutos)
$max_inactividad = 300; 

// Verificamos si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verificamos si ya hay un registro de la última actividad
if (isset($_SESSION['ultima_actividad'])) {
    $tiempo_inactivo = time() - $_SESSION['ultima_actividad'];
    if ($tiempo_inactivo > $max_inactividad) {
        // Tiempo excedido: destruir sesión y redirigir al login
        session_unset();
        session_destroy();
        header("Location: login.php?mensaje=sesion_expirada");
        exit();
    }
}

// Actualizamos la marca de tiempo de la última actividad
$_SESSION['ultima_actividad'] = time();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bienvenido - Clínica</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand" href="#">Clínica “Vida Sana”</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
      aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link" href="bienvenida.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="pacientes.php">Pacientes</a></li>
          <li class="nav-item"><a class="nav-link" href="medicos.php">Medicos</a></li>
          <li class="nav-item"><a class="nav-link" href="especialidades.php">Especialidades</a></li>

          <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="historiales.php">Historiales</a></li>
      </ul>
      <span class="navbar-text text-white me-3">
        Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
      </span>
      <a href="../controlador/cerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
  </div>
</nav>

<!-- Contenido Principal -->
<div class="container my-5">
  <div class="text-center">
    <h1 class="display-4 text-primary">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    <p class="lead mt-3">Usa el menú para gestionar pacientes, médicos, citas y historiales de la clínica.</p>
  </div>
</div>

<!-- Bootstrap JS Bundle (Popper + Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
