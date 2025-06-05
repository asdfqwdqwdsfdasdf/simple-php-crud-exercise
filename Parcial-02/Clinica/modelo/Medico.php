<?php
class Medico {
    // Declaración de variables públicas
    public $idmedico, $nombres, $apellidos, $especialidad_id, $telefono, $email;

    // Declaración del método constructor
    public function __construct($id, $nom, $ape, $especialidad_id, $tel, $ema) {
        $this->idmedico = $id;
        $this->nombres = $nom;
        $this->apellidos = $ape;
        $this->especialidad_id = $especialidad_id;
        $this->telefono = $tel;
        $this->email = $ema;
    }
}
?>
