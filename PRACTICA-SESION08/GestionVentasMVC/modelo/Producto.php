<?php
class Producto {
    // Declaración de variables públicas
    public $idproducto, $nombre, $precio, $stock;

    // Declaración del método constructor
    public function __construct($idproducto, $nombre, $precio, $stock) {
        // Asignación de valores recibidos mediante los parámetros a una instancia de la clase Producto
        $this->idproducto = $idproducto;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }
}
?>
