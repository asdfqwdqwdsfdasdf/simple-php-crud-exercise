<?php
require_once '../modelo/ProductoDAO.php';
require_once '../modelo/Producto.php';

$dao = new ProductoDAO();

if ($_POST['accion'] == 'Registrar') {
    $p = new Producto(
        $_POST['idproducto'], 
        $_POST['nombre'], 
        $_POST['precio'], 
        $_POST['stock']
    );
    $dao->insertar($p);

} elseif ($_POST['accion'] == 'Actualizar') {
    $p = new Producto(
        $_POST['idproducto'], 
        $_POST['nombre'], 
        $_POST['precio'], 
        $_POST['stock']
    );
    $dao->actualizar($p);
}

header("Location: ../vistas/productos.php");
exit;
?>
