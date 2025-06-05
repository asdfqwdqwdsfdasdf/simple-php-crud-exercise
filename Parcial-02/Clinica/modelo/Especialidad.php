<?php
class Especialidad {
    // Declaración de variables públicas
    public $idespecialidad, $nombre;

    // Declaración del método constructor
    public function __construct($id, $nombre) {
        $this->idespecialidad = $id;
        $this->nombre = $nombre;
    }
}
?>
