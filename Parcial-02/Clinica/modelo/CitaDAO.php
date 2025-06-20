<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Cita.php';

class CitaDAO {

    // CREATE: Insertar una nueva cita
    public function insertar($c) {
        $sql = "INSERT INTO citas (idcita, paciente_id, medico_id, fecha, hora, estado) VALUES (?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $c->idcita, $c->paciente_id, $c->medico_id,
            $c->fecha, $c->hora, $c->estado
        ]);
    }

    // READ: Listar todas las citas
    public function listar() {
        $sql = "SELECT c.*, 
                       p.nombres AS paciente_nombres, p.apellidos AS paciente_apellidos,
                       m.nombres AS medico_nombres, m.apellidos AS medico_apellidos
                FROM citas c
                LEFT JOIN pacientes p ON c.paciente_id = p.idpaciente
                LEFT JOIN medicos m ON c.medico_id = m.idmedico
                ORDER BY c.fecha DESC, c.hora DESC";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // READ con filtro: Buscar una cita por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM citas WHERE idcita = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de una cita
    public function actualizar($c) {
        $sql = "UPDATE citas SET paciente_id=?, medico_id=?, fecha=?, hora=?, estado=? WHERE idcita=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $c->paciente_id, $c->medico_id, $c->fecha,
            $c->hora, $c->estado, $c->idcita
        ]);
    }

    // DELETE: Eliminar una cita por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM citas WHERE idcita = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
