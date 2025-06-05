<?php
class Paciente {
    // Declaración de variables públicas
    public $idpaciente, $dni, $nombres, $apellidos, $direccion, $telefono, $email;

    // Declaración del método constructor
    public function __construct($id, $dni, $nom, $ape, $dir, $tel, $ema) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase Paciente
        $this->idpaciente = $id;
        $this->dni = $dni;
        $this->nombres = $nom;
        $this->apellidos = $ape;
        $this->direccion = $dir;
        $this->telefono = $tel;
        $this->email = $ema;
    }
}
?>
