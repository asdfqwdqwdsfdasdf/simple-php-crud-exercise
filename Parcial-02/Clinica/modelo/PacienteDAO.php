<?php
// Llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Paciente.php';

class PacienteDAO {

    // CREATE: Insertar un nuevo paciente
    public function insertar($p) {
        $sql = "INSERT INTO pacientes (idpaciente, dni, nombres, apellidos, direccion, telefono, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->idpaciente, $p->dni, $p->nombres, $p->apellidos,
            $p->direccion, $p->telefono, $p->email
        ]);
    }

    // READ: Listar todos los pacientes
    public function listar() {
        $sql = "SELECT * FROM pacientes";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar un paciente por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM pacientes WHERE idpaciente = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de un paciente
    public function actualizar($p) {
        $sql = "UPDATE pacientes SET dni=?, nombres=?, apellidos=?, direccion=?, telefono=?, email=? WHERE idpaciente=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->dni, $p->nombres, $p->apellidos, $p->direccion,
            $p->telefono, $p->email, $p->idpaciente
        ]);
    }

    // DELETE: Eliminar un paciente por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM pacientes WHERE idpaciente = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
