<?php
class Historial {
    // Declaración de variables públicas
    public $idhistorial, $cita_id, $diagnostico, $tratamiento, $observaciones;

    // Declaración del método constructor
    public function __construct($id, $cita_id, $diagnostico, $tratamiento, $observaciones) {
        $this->idhistorial = $id;
        $this->cita_id = $cita_id;
        $this->diagnostico = $diagnostico;
        $this->tratamiento = $tratamiento;
        $this->observaciones = $observaciones;
    }
}
?>
