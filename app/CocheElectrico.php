<?php
namespace App\AlquilerMovilidad;
use App\AlquilerMovilidad\Vehiculo;

class CocheElectrico extends Vehiculo {
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        private string $marcaModelo,
        private int $plazasMin,
        private int $plazasMax
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraInfoPlazas(): string {
        if ($this->plazasMin === 1 && $this->plazasMax === 1) {
            return "Para un pasajero";
        } elseif ($this->plazasMin === $this->plazasMax) {
            return "Para " . $this->plazasMin . " pasajeros";
        } else {
            return "De " . $this->plazasMin . " a " . $this->plazasMax . " pasajeros";
        }
    }

    public function muestraResumen(): void {
        parent::muestraResumen();

        echo "<p>Marca y modelo: " . $this->marcaModelo . "</p>";
        echo "<p>" . $this->muestraInfoPlazas() . "</p>";
    }
}
