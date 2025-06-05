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

require_once '../modelo/MedicoDAO.php';
$dao = new MedicoDAO();
$medicos = $dao->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lista de Médicos</title>
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

    <h1 class="mb-4 text-primary">Lista de Médicos</h1>

    <a href="agregar_medico.php" class="btn btn-primary mb-4">Agregar Médico</a>

    <?php if (!empty($medicos)): ?>
    <table class="table table-striped table-bordered">
      <thead class="table-primary">
        <tr>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Especialidad</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($medicos as $medico): ?>
        <tr>
          <td><?php echo htmlspecialchars($medico['nombres']); ?></td>
          <td><?php echo htmlspecialchars($medico['apellidos']); ?></td>
          <td><?php echo htmlspecialchars($medico['especialidad_nombre']); ?></td>
          <td><?php echo htmlspecialchars($medico['telefono']); ?></td>
          <td><?php echo htmlspecialchars($medico['email']); ?></td>
          <td>
            <a href="editar_medico.php?idmedico=<?php echo $medico['idmedico']; ?>" class="btn btn-sm btn-warning">Editar</a>

            <form action="../controlador/medicoControlador.php" method="POST" style="display:inline-block;">
              <input type="hidden" name="idmedico" value="<?php echo $medico['idmedico']; ?>">
              <input type="hidden" name="accion" value="Eliminar">
              <button type="submit" onclick="return confirm('¿Está seguro de eliminar este médico?');" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p class="text-danger">No hay médicos registrados.</p>
    <?php endif; ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
