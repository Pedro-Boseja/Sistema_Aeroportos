<?php

include_once "../global.php";

// criar um objeto da classe Aeroporto
$aeroporto = new Aeroporto('GRU', 'São Paulo', 'SP');

// verificar os valores dos atributos do objeto
echo 'Sigla: ' . $aeroporto->getSigla() . "\n";
echo 'Cidade: ' . $aeroporto->getCidade() . "\n";
echo 'Estado: ' . $aeroporto->getEstado() . "\n";

// alterar os valores dos atributos do objeto
$aeroporto->setSigla('CGH');
$aeroporto->setCidade('São Paulo');
$aeroporto->setEstado('SP');

// verificar os novos valores dos atributos do objeto
echo 'Sigla: ' . $aeroporto->getSigla() . "\n";
echo 'Cidade: ' . $aeroporto->getCidade() . "\n";
echo 'Estado: ' . $aeroporto->getEstado() . "\n";
