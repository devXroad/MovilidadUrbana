<?php
namespace App\AlquilerMovilidad;
use App\AlquilerMovilidad\Cliente;
use App\AlquilerMovilidad\Util\AlquilerMovilidadException;
use App\AlquilerMovilidad\Util\ClienteNoEncontradoException;
use App\AlquilerMovilidad\Util\VehiculoNoEncontradoException;

class AlquilerMovilidad{
    private array $vehiculos=[];
    private array $socios=[];
    public function __construct(
        private string $direccion
    ){

    }
    private function incluirVehiculo(Vehiculo $vehiculo):void{
        $this->vehiculos[] = $vehiculo;
    }
    public function incluirPatinete(string $titulo, float $precio, int $autonomiaKm): void {
        $numero = count($this->vehiculos) + 1;
        $patinete = new Patinete($titulo, $numero, $precio, $autonomiaKm);
        $this->incluirVehiculo($patinete);
    }

    public function incluirBicicletaElectrica(string $titulo, float $precio, int $marchas, string $tipo): void {
        $numero = count($this->vehiculos) + 1;
        $nuevaBicicleta = new BicicletaElectrica($titulo, $numero, $precio, $marchas, $tipo);
        $this->incluirVehiculo($nuevaBicicleta);
    }

    public function incluirCocheElectrico(string $titulo, float $precio, string $marcaModelo, int $plazasMin, int $plazasMax): void {
        $numero = count($this->vehiculos) + 1;
        $nuevoCocheElectrico = new CocheElectrico($titulo, $numero, $precio, $marcaModelo, $plazasMin, $plazasMax);
        $this->incluirVehiculo($nuevoCocheElectrico);
    }
    public function incluirSocio(String $nombre, int $maxAlquilerConcurrente=3):void{
        $numero=count($this->socios) +1;
        $nuevoCliente = new Cliente($nombre, $numero, $maxAlquilerConcurrente);
        $this->socios[]= $nuevoCliente;
    }

    public function listarVehiculos(): void {
        echo "<h3>Catálogo de vehículos en: " . $this->direccion . "</h3>";
        foreach ($this->vehiculos as $vehiculo){
            $vehiculo->muestraResumen();
            echo "<hr>";
        }
        echo "<br>";
    }

    public function listarSocios():void{
        echo "<h3>Listado de socios en: " . $this->direccion . "</h3>";
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
            echo "<hr>";
        }
    }

    public function alquilarClienteVehiculo(int $numCliente, int $numVehiculo): self {
        try {
            $clienteSeleccionado = null;
            $vehiculoSeleccionado = null;

            foreach ($this->socios as $socio) {
                if ($socio->getNumero() === $numCliente) {
                    $clienteSeleccionado = $socio;
                    break;
                }
            }

            if ($clienteSeleccionado === null) {
                throw new ClienteNoEncontradoException("No se ha encontrado el cliente con identificador: " . $numCliente);
            }

            foreach ($this->vehiculos as $vehiculo) {
                if ($vehiculo->getNumero() === $numVehiculo) {
                    $vehiculoSeleccionado = $vehiculo;
                    break;
                }
            }

            if ($vehiculoSeleccionado === null) {
                throw new VehiculoNoEncontradoException("No se ha encontrado el vehículo con identificador: " . $numVehiculo);
            }

            $clienteSeleccionado->alquilar($vehiculoSeleccionado);

        } catch (AlquilerMovilidadException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }

        return $this;
    }

}
