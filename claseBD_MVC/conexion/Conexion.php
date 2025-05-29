<?php
class Conexion {
    //funcion publica y estatica (no requiere una instancia para ser usada) : "conectar"
    public static function conectar() {
        // variables utilizadas para la conexion PDO
        $host = "localhost";
        $port = 3307;
        $dbname = "claseBD";
        $usuario = "root";
        $password = "";

        try {
            //  [ nombre-bd:host=(host);port=(port);dbname=(dbname) ] , [(usuario)] , [(password)]
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            // PDO (PHP Data Objects) es una extensión de PHP que proporciona 
            // una interfaz uniforme para acceder a diferentes bases de datos, permitiendo 
            // ejecutar consultas y manejar resultados de forma segura y eficiente mediante 
            // una capa de abstracción.
            $con = new PDO($dsn, $usuario, $password);
            // llamada del metodo setAttribute sobre el objeto PDO ("$con") para asignarle
            // ATTR_ERRMODE : lanzar warnings
            // ERRMODE_EXCEPTION : lanzar excepciones
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // retornar el objeto $con
            return $con;
        } catch (PDOException $e) {
            // manejo de errores
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
