<?php
include "Vehiculo.php";
include "Patinete.php";
include "BicicletaElectrica.php";
include "CocheElectrico.php";

$vehiculo1 = new Vehiculo("Patinete xiaomi pro 2", 22, 3);
$vehiculo1->muestraResumen();

$miPatinete = new Patinete("Patinete Xiaomi Mi Electric Pro 2", 23, 3.5, 45, 22);
$miPatinete->muestraResumen();

$miBici = new BicicletaElectrica("Bici Eléctrica Orbea Vibe", 24, 1200.50, 7, "Urbana");
$miBici->muestraResumen();

// Prueba rango de plazas
$miCoche1 = new CocheElectrico("Coche Eléctrico Tesla", 40, 25000, "Tesla Model 3", 1, 5);
$miCoche1->muestraResumen();

// Prueba solo un pasajero
$miCoche2 = new CocheElectrico("Coche Eléctrico Twizy", 41, 7000, "Renault Twizy", 1, 1);
$miCoche2->muestraResumen();