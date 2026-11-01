<?php
namespace App\AlquilerMovilidad;

use App\AlquilerMovilidad\Util\VehiculoYaAlquiladoException;
use App\AlquilerMovilidad\Util\CupoSuperadoException;
use App\AlquilerMovilidad\Util\VehiculoNoEncontradoException;
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

    public function alquilar(Vehiculo $vehiculo): self {
        if ($this->tieneAlquilado($vehiculo)) {
            throw new VehiculoYaAlquiladoException("El cliente <strong>{$this->nombre}</strong> ya tiene alquilado este vehículo.");
        }

        if ($vehiculo->alquilado) {
            throw new VehiculoYaAlquiladoException("El vehículo <strong>{$vehiculo->titulo}</strong> ya está alquilado.");
        }

        if (count($this->vehiculosAlquilados) >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("El cliente <strong>{$this->nombre}</strong> ha alcanzado su límite de {$this->maxAlquilerConcurrente} alquileres simultáneos.");
        }

        $this->vehiculosAlquilados[] = $vehiculo;
        $this->numVehiculosAlquilados++;
        $vehiculo->alquilado = true;

        echo "<p>Vehículo alquilado correctamente por <strong>{$this->nombre}</strong>.</p>";
        return $this;
    }

    public function devolver(int $numVehiculo): self {
        foreach ($this->vehiculosAlquilados as $indice => $vehiculo) {
            if ($vehiculo->getNumero() === $numVehiculo) {
                $vehiculo->alquilado = false;
                unset($this->vehiculosAlquilados[$indice]);
                $this->numVehiculosAlquilados--;
                echo "<p>El vehículo ha sido devuelto con éxito.</p>";
                return $this;
            }
        }
        throw new VehiculoNoEncontradoException("El vehículo {$numVehiculo} no estaba alquilado.");
    }

    public function listaAlquileres():void{
        echo "<p>Alquileres del cliente: " . count($this->vehiculosAlquilados) . "</p>";

        foreach ($this->vehiculosAlquilados as $vehiculo) {
            $vehiculo->muestraResumen();
        }
    }

}