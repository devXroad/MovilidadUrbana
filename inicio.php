<?php
include "Vehiculo.php";
include "Patinete.php";
include "BicicletaElectrica.php";

$vehiculo1 = new Vehiculo("Patinete xiaomi pro 2", 22, 3);
$vehiculo1->muestraResumen();

$miPatinete = new Patinete("Patinete Xiaomi Mi Electric Pro 2", 23, 3.5, 45, 22);
$miPatinete->muestraResumen();

$miBici = new BicicletaElectrica("Bici Eléctrica Orbea Vibe", 24, 1200.50, 7, "Urbana");
$miBici->muestraResumen();