<?php
class Cliente{
    private int $numVehiculosAlquilados = 0;
    private array $vehiculosAlquilados= [];

    public function __construct(
        private string $nombre,
        private int $numero,
        private int $maxAlquilerConcurrente = 3
    ) {

    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function setNumero(int $numero): void {
        $this->numero = $numero;
    }

    public function getNumVehiculosAlquilados(): int {
        return $this->numVehiculosAlquilados;
    }

    public function muestraResumen(): void {
        echo "<strong>Cliente: " . $this->nombre . "</strong>";
        echo "<p>Cantidad de alquileres activos: " . count($this->vehiculosAlquilados) . "</p>";
    }
}