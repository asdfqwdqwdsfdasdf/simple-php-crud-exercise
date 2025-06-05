<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Especialidad.php';

class EspecialidadDAO {

    // CREATE: Insertar una nueva especialidad
    public function insertar($e) {
        $sql = "INSERT INTO especialidades (idespecialidad, nombre) VALUES (?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $e->idespecialidad, $e->nombre
        ]);
    }

    // READ: Listar todas las especialidades
    public function listar() {
        $sql = "SELECT * FROM especialidades";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ con filtro: Buscar una especialidad por su ID
    public function buscar($id) {
        $sql = "SELECT * FROM especialidades WHERE idespecialidad = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar los datos de una especialidad
    public function actualizar($e) {
        $sql = "UPDATE especialidades SET nombre=? WHERE idespecialidad=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $e->nombre, $e->idespecialidad
        ]);
    }

    // DELETE: Eliminar una especialidad por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM especialidades WHERE idespecialidad = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
