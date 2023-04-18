<?php

include_once ('../Classes/class.passagem.php');
include_once ('../Classes/class.viagem.php');
include_once ('../Classes/class.passageiro.php');
include_once ('../Classes/class.aeronave.php');
include_once ('../Classes/class.aeroporto.php');

// criar um objeto da classe Passagem
$aeronave = new Aeronave ("AvioesTalita", "AeroTalit3000", "TA-LIT", 180, 10000.7);
$aeroporto_saida = new Aeroporto ("CNF", "Belo Horizonte", "Minas Gerais");
$aeroporto_chegada = new Aeroporto ("GUA", "Guarulhos", "Sao Paulo");
$data_s = date_create ('2023-04-18 19:00:00');
$data_c = date_create ('2023-04-18 20:30:00');
$viagem = new Viagem ($data_s, $data_c, $aeronave, "TA4444", $aeroporto_chegada, $aeroporto_saida);
$viagem2 = new Viagem ($data_s, $data_c, $aeronave, "TA5454", $aeroporto_chegada, $aeroporto_saida);
$passageiro = new Passageiro ();
$passagem = new Passagem (50.0, $viagem, "27D", $passageiro);

// verificar os valores dos atributos do objeto
echo 'Tarifa: ' . $passagem->getTarifa() . "\n";
echo 'Viagem: ' . $passagem->getViagem()->getCodigo() . "\n";
echo 'Assento: ' . $passagem->getAssento() . "\n";
//echo 'Passageiro: ' . $passagem->getPassageiro() . "";
echo 'Status: ' . $passagem->getStatus() . "\n";

// alterar os valores dos atributos do objeto
$passagem->setTarifa(55.5);
$passagem->setViagem($viagem2);
$passagem->setAssento("15A");
//$passagem->setPassageiro();
//$passagem->setStatus();

// verificar os novos valores dos atributos do objeto
echo 'Tarifa: ' . $passagem->getTarifa() . "\n";
echo 'Viagem: ' . $passagem->getViagem()->getCodigo() . "\n";
echo 'Assento: ' . $passagem->getAssento() . "\n";
//echo 'Passageiro: ' . $passagem->getPassageiro() . "\n";
echo 'Status: ' . $passagem->getStatus() . "\n";

// testando check-in
$passagem->CheckIn();
