<?php
class DetallePedido {
    // Declaración de variables públicas
    public $iddetalle, $idpedido, $idproducto, $cantidad, $subtotal;

    // Declaración del método constructor
    public function __construct($iddetalle, $idpedido, $idproducto, $cantidad, $subtotal) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase DetallePedido
        $this->iddetalle = $iddetalle;
        $this->idpedido = $idpedido;
        $this->idproducto = $idproducto;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }
}
?>
