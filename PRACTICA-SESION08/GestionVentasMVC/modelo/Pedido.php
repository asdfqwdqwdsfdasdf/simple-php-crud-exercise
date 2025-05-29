<?php
class Pedido {
    // Declaración de variables públicas
    public $idpedido, $fecha, $idcliente;

    // Declaración del método constructor
    public function __construct($idpedido, $fecha, $idcliente) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase Pedido
        $this->idpedido = $idpedido;
        $this->fecha = $fecha;
        $this->idcliente = $idcliente;
    }
}
?>
