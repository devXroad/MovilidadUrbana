<?php

class CocheElectrico extends Vehiculo {
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        public string $marcaModelo,
        public int $plazasMin,
        public int $plazasMax
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraInfoPlazas(): void {
        if ($this->plazasMin === 1 && $this->plazasMax === 1) {
            echo "<p>Para un pasajero</p>";
        } elseif ($this->plazasMin === $this->plazasMax) {
            echo "<p>Para " . $this->plazasMin . " pasajeros</p>";
        } else {
            echo "<p>De " . $this->plazasMin . " a " . $this->plazasMax . " pasajeros</p>";
        }
    }

    public function muestraResumen(): void {
        parent::muestraResumen();

        echo "<p>Marca y modelo: " . $this->marcaModelo . "</p>";
        $this->muestraInfoPlazas();
    }
}
