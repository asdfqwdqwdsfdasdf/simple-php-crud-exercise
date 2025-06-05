<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Historial.php';

class HistorialDAO {

    // CREATE: Insertar un nuevo historial clínico
    public function insertar($h) {
        $sql = "INSERT INTO historiales (idhistorial, cita_id, diagnostico, tratamiento, observaciones) VALUES (?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $h->idhistorial, $h->cita_id, $h->diagnostico,
            $h->tratamiento, $h->observaciones
        ]);
    }

    // READ: Listar todos los historiales
    public function listarConDetalles() {
        $sql = "SELECT h.idhistorial, h.cita_id, h.diagnostico, h.tratamiento, h.observaciones,
                       c.fecha, c.hora, c.estado,
                       p.nombres AS paciente_nombres, p.apellidos AS paciente_apellidos,
                       m.nombres AS medico_nombres, m.apellidos AS medico_apellidos
                FROM historiales h
                INNER JOIN citas c ON h.cita_id = c.idcita
                INNER JOIN pacientes p ON c.paciente_id = p.idpaciente
                INNER JOIN medicos m ON c.medico_id = m.idmedico
                ORDER BY c.fecha DESC, c.hora DESC";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // READ con filtro: Buscar un historial por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM historiales WHERE idhistorial = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un historial
    public function actualizar($h) {
        $sql = "UPDATE historiales SET cita_id=?, diagnostico=?, tratamiento=?, observaciones=? WHERE idhistorial=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $h->cita_id, $h->diagnostico, $h->tratamiento,
            $h->observaciones, $h->idhistorial
        ]);
    }

    // DELETE: Eliminar un historial por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM historiales WHERE idhistorial = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
