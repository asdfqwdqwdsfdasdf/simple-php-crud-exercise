<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/DetallePedido.php';

class DetallePedidoDAO {

    // CREATE: Insertar un nuevo detalle de pedido
    public function insertar($dp) {
        $sql = "INSERT INTO detalle_pedido (idpedido, idproducto, cantidad, subtotal) VALUES (?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $dp->idpedido, $dp->idproducto, $dp->cantidad, $dp->subtotal
        ]);
    }

    // READ: Listar todos los detalles de un pedido
    public function listarPorPedido($idpedido) {
        $sql = "SELECT * FROM detalle_pedido WHERE idpedido = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$idpedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un detalle de pedido por su ID
    public function buscar($iddetalle) {
        $sql = "SELECT * FROM detalle_pedido WHERE iddetalle = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$iddetalle]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los detalles de un pedido
    public function actualizar($dp) {
        $sql = "UPDATE detalle_pedido SET cantidad = ?, subtotal = ? WHERE iddetalle = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $dp->cantidad, $dp->subtotal, $dp->iddetalle
        ]);
    }

    // DELETE: Eliminar un detalle de pedido por su ID
    public function eliminar($iddetalle) {
        $sql = "DELETE FROM detalle_pedido WHERE iddetalle = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$iddetalle]);
    }
}
?>
