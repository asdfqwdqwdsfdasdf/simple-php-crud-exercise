<?php
class Persona {
    // declaracion de variables publicas 
    public $idpersona, $apellidos, $nombres, $fechaNacimiento, $direccion, $telefono, $email;
    // declaracion del metodo constructor 
    public function __construct($id, $ape, $nom, $fec, $dir, $tel, $ema) {
        // asignacion de valores recibidos mediante los parametros a una instancia de la clase Persona
        //  mediante $this 
        $this->idpersona = $id;
        $this->apellidos = $ape;
        $this->nombres = $nom;
        $this->fechaNacimiento = $fec;
        $this->direccion = $dir;
        $this->telefono = $tel;
        $this->email = $ema;
    }
}
?>