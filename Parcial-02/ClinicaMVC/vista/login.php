<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión - Clínica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f0f4f8;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-card {
      background: white;
      padding: 2.5rem 3rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      transition: box-shadow 0.3s ease;
    }
    .login-card:hover {
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }
    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0.25);
    }
    .btn-primary {
      width: 100%;
      font-weight: 600;
      padding: 0.6rem;
      font-size: 1.1rem;
      border-radius: 8px;
    }
    .logo {
      width: 80px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <main class="login-card text-center">
    <!-- Logo opcional -->
    <img src="https://cdn-icons-png.flaticon.com/512/2975/2975235.png" alt="Logo Clínica" class="logo mx-auto d-block" />
    
    <h2 class="mb-4 fw-bold text-primary">Iniciar Sesión</h2>

    <form action="../controlador/loginControlador.php" method="post" novalidate>
      <div class="mb-3 text-start">
        <label for="usuario" class="form-label fw-semibold">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese su usuario" required autofocus />
        <div class="invalid-feedback">Por favor, ingrese su usuario.</div>
      </div>

      <div class="mb-4 text-start">
        <label for="clave" class="form-label fw-semibold">Contraseña</label>
        <input type="password" id="clave" name="clave" class="form-control" placeholder="Ingrese su contraseña" required />
        <div class="invalid-feedback">Por favor, ingrese su contraseña.</div>
      </div>

      <button type="submit" class="btn btn-primary">Ingresar</button>
      <a href="registro.php" target="_blank">Registrarse</a>
 
    </form>
  </main>

  <script>
    // Validación simple Bootstrap 5
    (() => {
      'use strict'
      const forms = document.querySelectorAll('form')
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
