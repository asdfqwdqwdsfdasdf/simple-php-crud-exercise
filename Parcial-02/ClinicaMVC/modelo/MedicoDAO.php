<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Medico.php';

class MedicoDAO {

    // CREATE: Insertar un nuevo médico
    public function insertar($m) {
        $sql = "INSERT INTO medicos (idmedico, nombres, apellidos, especialidad_id, telefono, email) VALUES (?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $m->idmedico, $m->nombres, $m->apellidos, $m->especialidad_id,
            $m->telefono, $m->email
        ]);
    }

    // READ: Listar todos los médicos
    public function listar() {
        $sql = "SELECT * FROM medicos";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un médico por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM medicos WHERE idmedico = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un médico
    public function actualizar($m) {
        $sql = "UPDATE medicos SET nombres=?, apellidos=?, especialidad_id=?, telefono=?, email=? WHERE idmedico=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $m->nombres, $m->apellidos, $m->especialidad_id,
            $m->telefono, $m->email, $m->idmedico
        ]);
    }

    // DELETE: Eliminar un médico por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM medicos WHERE idmedico = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
