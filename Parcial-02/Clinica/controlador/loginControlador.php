<?php
session_start();
require_once '../conexion/Conexion.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$con = Conexion::conectar();
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$usuario]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($clave, $user['clave'])) {
    $_SESSION['usuario'] = $usuario;
    header("Location: ../vista/bienvenida.php");
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Error de autenticación</title>
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
        .error-card {
          background: white;
          padding: 2rem 2.5rem;
          border-radius: 12px;
          box-shadow: 0 8px 24px rgba(0,0,0,0.1);
          max-width: 400px;
          text-align: center;
        }
      </style>
    </head>
    <body>
      <div class="error-card">
        <h3 class="text-danger mb-3">¡Error de autenticación!</h3>
        <p class="mb-4">Usuario o contraseña incorrectos.</p>
        <a href="../vista/login.php" class="btn btn-primary">Intentar de nuevo</a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
    exit();
}
?>
