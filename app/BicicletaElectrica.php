<?php
namespace App\AlquilerMovilidad;
class BicicletaElectrica extends Vehiculo {
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        private int $marchas,
        private string $tipo
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void {
        parent::muestraResumen();

        echo "<p>Marchas: " . $this->marchas . "</p>";
        echo "<p>Tipo: " . $this->tipo . "</p>";
    }

}

