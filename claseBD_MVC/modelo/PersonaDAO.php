<?php
// llamada de archivos necesarios
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Persona.php';

class PersonaDAO {


    // CREATE
    public function insertar($p) {
        $sql = "INSERT INTO persona VALUES (?, ?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        //$stmt = $con->prepare($sql);
        return $con->execute([
            $p->idpersona, $p->apellidos, $p->nombres,
            $p->fechaNacimiento, $p->direccion,
            $p->telefono, $p->email
        ]);
    }

    // READ
    public function listar() {
        $sql = "SELECT * FROM persona";
        $con = Conexion::conectar();
        return $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // READ with filter
    public function buscar($id) {
        $sql = "SELECT * FROM persona WHERE idpersona = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function actualizar($p) {
        $sql = "UPDATE persona SET apellidos=?, nombres=?, fechaNacimiento=?, direccion=?, telefono=?, email=? WHERE idpersona=?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->apellidos, $p->nombres, $p->fechaNacimiento,
            $p->direccion, $p->telefono, $p->email, $p->idpersona
        ]);
    }

    // DELETE
    public function eliminar($id) {
        $sql = "DELETE FROM persona WHERE idpersona = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }




}
?>