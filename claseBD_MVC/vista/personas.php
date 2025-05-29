<?php
require_once '../modelo/PersonaDAO.php';
$dao = new PersonaDAO();
$personas = $dao->listar();
?>
<!DOCTYPE html>
<html>
<head><title>Personas</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Registrar Persona</h2>
    <form action="../controlador/personaControlador.php" method="post">
        ID: <input type="text" name="idpersona"><br>
        Apellidos: <input type="text" name="apellidos"><br>
        Nombres: <input type="text" name="nombres"><br>
        Fecha Nacimiento: <input type="date" name="fechaNacimiento"><br>
        Dirección: <input type="text" name="direccion"><br>
        Teléfono: <input type="text" name="telefono"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" name="accion" value="Registrar">
    </form>
    <h2>Lista de Personas</h2>
    <table border="1">
        <tr><th>ID</th><th>Apellidos</th><th>Nombres</th><th>Fecha</th><th>Dirección</th><th>Teléfono</th><th>Email</th><th>Acciones</th></tr>
        <?php foreach($personas as $p): ?>
        <tr>
            <td><?= $p['idpersona'] ?></td>
            <td><?= $p['apellidos'] ?></td>
            <td><?= $p['nombres'] ?></td>
            <td><?= $p['fechaNacimiento'] ?></td>
            <td><?= $p['direccion'] ?></td>
            <td><?= $p['telefono'] ?></td>
            <td><?= $p['email'] ?></td>
            <td><a href="editar_persona.php?id=<?= $p['idpersona'] ?>">Editar</a> | <a href="../controlador/eliminarPersona.php?id=<?= $p['idpersona'] ?>">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>