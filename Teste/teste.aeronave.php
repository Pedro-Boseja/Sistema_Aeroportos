<?php

// incluir a definição da classe Aeronave
include 'class.aeronave.php';

// criar um objeto da classe Aeronave
$aviao = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5);

// verificar os valores dos atributos do objeto
echo 'Fabricante: ' . $aviao->getFabricante() . "\n";
echo 'Modelo: ' . $aviao->getModelo() . "\n";
echo 'Registro: ' . $aviao->getRegistro() . "\n";
echo 'Capacidade de passageiros: ' . $aviao->getCapacidadeP() . "\n";
echo 'Capacidade de combustível: ' . $aviao->getCapacidadeC() . "\n";