<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Pedido.php';

class PedidoDAO {

    // CREATE: Insertar un nuevo pedido
    public function insertar($p) {
        $sql = "INSERT INTO pedido (idpedido, fecha, idcliente) VALUES (?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->idpedido, $p->fecha, $p->idcliente
        ]);
    }

    // READ: Listar todos los pedidos
    public function listar() {
        $sql = "SELECT * FROM pedido";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un pedido por su ID
    public function buscar($idpedido) {
        $sql = "SELECT * FROM pedido WHERE idpedido = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$idpedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un pedido
    public function actualizar($p) {
        $sql = "UPDATE pedido SET fecha = ?, idcliente = ? WHERE idpedido = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->fecha, $p->idcliente, $p->idpedido
        ]);
    }

    // DELETE: Eliminar un pedido por su ID
    public function eliminar($idpedido) {
        $sql = "DELETE FROM pedido WHERE idpedido = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$idpedido]);
    }
}
?>
