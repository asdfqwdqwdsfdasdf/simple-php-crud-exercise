<?php
class Producto {
    public $idproducto;
    public $nombre;
    public $precio;
    public $stock;

    public function __construct($idproducto = null, $nombre = null, $precio = null, $stock = null) {
        $this->idproducto = $idproducto;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }
}
?>