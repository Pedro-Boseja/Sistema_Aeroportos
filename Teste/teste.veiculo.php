<?php

include_once "../global.php";

$veiculo = new Veiculo (12, 18.0);

echo $veiculo->getCapacidade() . "\n";
echo $veiculo->getVMedia() . "\n";