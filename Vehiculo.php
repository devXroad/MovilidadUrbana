<?php
include_once "Resumible.php";
abstract class Vehiculo implements Resumible {
    private const float IVA = 0.21;
    public function __construct(
        public string $titulo,
        private int $numero,
        private float $precio,
    ){

    }

    public function getPrecio(): float{
        return $this->precio;
    }

    public function getNumero(): int{
        return $this->numero;
    }

    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getPrecioConIVA(): float{
        // accede a la constante de la clase con self::
        return $this->precio + ($this->precio * self::IVA);
    }

    public function muestraResumen():void{
        echo "<strong>" . $this->titulo . "</strong>";
        echo "<p>Precio " . $this->getPrecio(). " euros</p>";
        echo "<p>Precio IVA incluido: " . $this->getPrecioConIVA(). " euros</p>";
    }

}