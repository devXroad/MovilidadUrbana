<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\AlquilerMovilidad\Cliente;
use App\AlquilerMovilidad\Patinete;
use App\AlquilerMovilidad\CocheElectrico;
use App\AlquilerMovilidad\BicicletaElectrica;
use App\AlquilerMovilidad\Util\AlquilerMovilidadException;

//instanciamos objetos cliente
$cliente1 = new Cliente("Bruce Wayne", 23);
$cliente2 = new Cliente("Clark Kent", 33);

//mostramos el número de cada cliente creado
echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero();

//instancia de vehículos
$v1 = new Patinete("Patinete Xiaomi Pro 2", 23, 3.5, 45, 25);
$v2 = new CocheElectrico("Tesla Model 3", 26, 49.99, "Tesla Model 3 SR", 5, 5);
$v3 = new BicicletaElectrica("Orbea Vibe", 24, 15, 3, "Urbana");
$v4 = new Patinete("Ninebot Max", 4, 3, 65, 30);

$cliente1->alquilar($v1);
$cliente1->alquilar($v2);
$cliente1->alquilar($v3);

//intentar alquilar de nuevo un vehículo que ya tiene alquilado
try {
    $cliente1->alquilar($v1);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

//el cliente tiene 3 vehículos en alquiler como máximo
//este vehículo no lo va a poder alquilar
try {
    $cliente1->alquilar($v4);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

//este vehículo no lo tiene alquilado
try {
    $cliente1->devolver(4);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

//devuelvo un vehículo
try {
    $cliente1->devolver(2);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

//alquilo otro vehículo
try {
    $cliente1->alquilar($v4);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

//listar los alquilados
$cliente1->listaAlquileres();

//este cliente no tiene alquileres
try {
    $cliente2->devolver(2);
} catch (AlquilerMovilidadException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}