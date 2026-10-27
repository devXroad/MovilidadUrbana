<?php
include "Vehiculo.php";
include "Patinete.php";

$vehiculo1 = new Vehiculo("Patinete xiaomi pro 2", 22, 3);
$vehiculo1->muestraResumen();

$miPatinete = new Patinete("Patinete Xiaomi Mi Electric Pro 2", 23, 3.5, 45, 22);
$miPatinete->muestraResumen();