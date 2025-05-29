<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Cliente.php';

class ClienteDAO {

    // CREATE: Insertar un nuevo cliente
    public function insertar($c) {
        $sql = "INSERT INTO cliente (idcliente, apellidos, nombres, direccion, telefono, email) VALUES (?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $c->idcliente, $c->apellidos, $c->nombres,
            $c->direccion, $c->telefono, $c->email
        ]);
    }

    // READ: Listar todos los clientes
    public function listar() {
        $sql = "SELECT * FROM cliente";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un cliente por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM cliente WHERE idcliente = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un cliente
    public function actualizar($c) {
        $sql = "UPDATE cliente SET apellidos=?, nombres=?, direccion=?, telefono=?, email=? WHERE idcliente=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $c->apellidos, $c->nombres, $c->direccion,
            $c->telefono, $c->email, $c->idcliente
        ]);
    }

    // DELETE: Eliminar un cliente por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM cliente WHERE idcliente = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
