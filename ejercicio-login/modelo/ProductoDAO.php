<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Producto.php';

class ProductoDAO {

    // CREATE
    public function insertar($p) {
        $sql = "INSERT INTO producto (idproducto, nombre, precio, stock) VALUES (?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->idproducto,
            $p->nombre,
            $p->precio,
            $p->stock
        ]);
    }

    // READ (listar todos)
    public function listar() {
        $sql = "SELECT * FROM producto";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro por idproducto
    public function buscar($id) {
        $sql = "SELECT * FROM producto WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function actualizar($p) {
        $sql = "UPDATE producto SET nombre = ?, precio = ?, stock = ? WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->nombre,
            $p->precio,
            $p->stock,
            $p->idproducto
        ]);
    }

    // DELETE
    public function eliminar($id) {
        $sql = "DELETE FROM producto WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
