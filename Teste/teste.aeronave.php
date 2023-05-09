<?php

// incluir a definição da classe Aeronave
include '../Classes/class.aeronave.php';

// criar um objeto da classe Aeronave
$aviao = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5, 6, 30);

// verificar os valores dos atributos do objeto
echo 'Fabricante: ' . $aviao->getFabricante() . "\n";
echo 'Modelo: ' . $aviao->getModelo() . "\n";
echo 'Registro: ' . $aviao->getRegistro() . "\n";
echo 'Capacidade de passageiros: ' . $aviao->getCapacidadeP() . "\n";
echo 'Capacidade de combustível: ' . $aviao->getCapacidadeC() . "\n";
echo 'Assentos: ';
$a = array_keys($aviao->getAssentos());
foreach($a as $al){
    echo "$al" . "\n";
}
echo "\n";