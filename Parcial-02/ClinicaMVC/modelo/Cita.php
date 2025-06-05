<?php
class Cita {
    // Declaración de variables públicas
    public $idcita, $paciente_id, $medico_id, $fecha, $hora, $estado;

    // Declaración del método constructor
    public function __construct($id, $paciente_id, $medico_id, $fecha, $hora, $estado) {
        $this->idcita = $id;
        $this->paciente_id = $paciente_id;
        $this->medico_id = $medico_id;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estado = $estado;
    }
}
?>
