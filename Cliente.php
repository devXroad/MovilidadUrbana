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

    public function tieneAlquilado(Vehiculo $vehiculo): bool{
        return in_array($vehiculo, $this->vehiculosAlquilados, true); //true para comprobar que sea exactamente el mismo objeto
    }

    public function alquilar(Vehiculo $vehiculo):bool{
        if($this->tieneAlquilado($vehiculo)){
            echo "<p>Error: El cliente <strong>{$this->nombre}</strong> ya tiene alquilado este vehículo.</p>";
            return false;
        }

        if (count($this->vehiculosAlquilados) >= $this->maxAlquilerConcurrente){
            echo "<p>Error: El cliente <strong>{$this->nombre}</strong> ha alcanzado su límite de {$this->maxAlquilerConcurrente} alquileres simultáneos.</p>";
            return false;
        }

        $this->vehiculosAlquilados[] = $vehiculo;
        $this->numVehiculosAlquilados++;

        echo "<p>Vehículo alquilado correctamente por <strong>{$this->nombre}</strong>.</p>";
        return true;
    }

}