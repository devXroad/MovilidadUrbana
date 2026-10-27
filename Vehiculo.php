<?php
class Vehiculo{
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




}