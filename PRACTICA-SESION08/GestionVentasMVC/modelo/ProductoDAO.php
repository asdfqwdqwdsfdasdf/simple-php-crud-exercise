<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Producto.php';

class ProductoDAO {

    // CREATE: Insertar un nuevo producto
    public function insertar($p) {
        $sql = "INSERT INTO producto (idproducto, nombre, precio, stock) VALUES (?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->idproducto, $p->nombre, $p->precio, $p->stock
        ]);
    }

    // READ: Listar todos los productos
    public function listar() {
        $sql = "SELECT * FROM producto";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un producto por su ID
    public function buscar($idproducto) {
        $sql = "SELECT * FROM producto WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$idproducto]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un producto
    public function actualizar($p) {
        $sql = "UPDATE producto SET nombre = ?, precio = ?, stock = ? WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->nombre, $p->precio, $p->stock, $p->idproducto
        ]);
    }

    // DELETE: Eliminar un producto por su ID
    public function eliminar($idproducto) {
        $sql = "DELETE FROM producto WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$idproducto]);
    }

    // Validación de stock disponible
    public function validarStock($idproducto, $cantidad) {
        $sql = "SELECT stock FROM producto WHERE idproducto = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$idproducto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($producto) {
            return $producto['stock'] >= $cantidad;  // Retorna verdadero si hay suficiente stock
        }
        return false; // Si no encuentra el producto, retorna falso
    }
}
?>
