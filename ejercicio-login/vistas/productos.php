<?php
require_once '../modelo/ProductoDAO.php';
$dao = new ProductoDAO();
$productos = $dao->listar();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Registrar Producto</h2>
    <form action="../controlador/productoControlador.php" method="post">
        ID: <input type="text" name="idproducto"><br>
        Nombre: <input type="text" name="nombre"><br>
        Precio: <input type="number" step="0.01" name="precio"><br>
        Stock: <input type="number" name="stock"><br>
        <input type="submit" name="accion" value="Registrar">
    </form>

    <h2>Lista de Productos</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
        </tr>
        <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= $p['idproducto'] ?></td>
            <td><?= $p['nombre'] ?></td>
            <td><?= $p['precio'] ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <a href="editar_producto.php?id=<?= $p['idproducto'] ?>">Editar</a> |
                <a href="../controlador/eliminarProducto.php?id=<?= $p['idproducto'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
