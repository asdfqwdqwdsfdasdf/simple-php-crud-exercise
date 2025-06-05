<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro de Usuario - Clínica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }
    .registro-form {
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
    }
  </style>
</head>
<body>

  <form class="registro-form" action="../controlador/registrar.php" method="post" onsubmit="return validarClaves()">
    <h2 class="mb-4 text-primary text-center">Registrar Nuevo Usuario</h2>

    <div class="mb-3">
      <label for="idusuario" class="form-label">ID Usuario</label>
      <input type="text" id="idusuario" name="idusuario" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario</label>
      <input type="text" id="usuario" name="usuario" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="clave" class="form-label">Clave</label>
      <input type="password" id="clave" name="clave" class="form-control" required minlength="6" />
    </div>

    <div class="mb-3">
      <label for="confirmar" class="form-label">Confirmar Clave</label>
      <input type="password" id="confirmar" name="confirmar" class="form-control" required minlength="6" />
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrar</button>

    <div class="text-center mt-3">
      <a href="login.php" class="text-decoration-none">Volver al Login</a>
    </div>
  </form>

  <script>
    function validarClaves() {
      const clave = document.getElementById('clave').value;
      const confirmar = document.getElementById('confirmar').value;
      if (clave !== confirmar) {
        alert('Las claves no coinciden.');
        return false;
      }
      return true;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
