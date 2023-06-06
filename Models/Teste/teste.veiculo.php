<?php

include_once "../global.php";

$veiculo = new Veiculo (12, 18.0);

echo $veiculo->getCapacidade() . "\n";
echo $veiculo->getVMedia() . "\n";

$endereço1 = "Sete Lagoas, MG, Rua Maria Ferreira Saraiva, 57";
$endereço2 = "Belo Horizonte, MG, Rua João Fernandes, 113";

$distancia = $veiculo->CalculaDistancia($endereço1, $endereço2);

echo "A distância entre os dois endereços dados é de " . $distancia . " metros\n";