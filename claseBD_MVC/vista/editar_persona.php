<?php
require_once '../modelo/PersonaDAO.php';
$dao = new PersonaDAO();
$p = $dao->buscar($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head><title>Editar Persona</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Editar Persona</h2>
    <form action="../controlador/personaControlador.php" method="post">
        ID: <input type="text" name="idpersona" value="<?= $p['idpersona'] ?>" readonly><br>
        Apellidos: <input type="text" name="apellidos" value="<?= $p['apellidos'] ?>"><br>
        Nombres: <input type="text" name="nombres" value="<?= $p['nombres'] ?>"><br>
        Fecha Nacimiento: <input type="date" name="fechaNacimiento" value="<?= $p['fechaNacimiento'] ?>"><br>
        Dirección: <input type="text" name="direccion" value="<?= $p['direccion'] ?>"><br>
        Teléfono: <input type="text" name="telefono" value="<?= $p['telefono'] ?>"><br>
        Email: <input type="email" name="email" value="<?= $p['email'] ?>"><br>
        <input type="submit" name="accion" value="Actualizar">
    </form>
</body>
</html>
