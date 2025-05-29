<?php
class Cliente {
    // Declaración de variables públicas
    public $idcliente, $apellidos, $nombres, $direccion, $telefono, $email;

    // Declaración del método constructor
    public function __construct($id, $ape, $nom, $dir, $tel, $ema) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase Cliente
        $this->idcliente = $id;
        $this->apellidos = $ape;
        $this->nombres = $nom;
        $this->direccion = $dir;
        $this->telefono = $tel;
        $this->email = $ema;
    }

}
?>