<?php
class Conexion {
    public static function conectar() {
        $host = "localhost";
        $port = 3307;
        $dbname = "clinica";
        $usuario = "root";
        $password = "";

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            $conexion = new PDO($dsn, $usuario, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
?>
