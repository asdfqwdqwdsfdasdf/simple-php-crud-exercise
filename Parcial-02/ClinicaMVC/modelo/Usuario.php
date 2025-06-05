<?php
class Usuario {
    // Declaración de variables públicas
    public $idusuario, $usuario, $clave;

    // Declaración del método constructor
    public function __construct($idusuario, $usuario, $clave) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase Usuario
        $this->idusuario = $idusuario;
        $this->usuario = $usuario;
        $this->clave = $clave;
    }
}
?>
