<?php

include_once ('../classes/class.passagem.php');
include_once ('../classes/class.viagem.php');
include_once ('../classes/class.passageiro.php');
include_once ('../classes/class.aeronave.php');
include_once ('../classes/class.aeroporto.php');

// criar um objeto da classe Passagem
$aeronave = new Aeronave ("AvioesTalita", "AeroTalit3000", "TA-LIT", 180, 10000.7, 32, 6);

$aeroporto_saida = new Aeroporto ("CNF", "Belo Horizonte", "Minas Gerais");
$aeroporto_chegada = new Aeroporto ("GUA", "Guarulhos", "Sao Paulo");

$data_s = new DateTime ('2023-04-22 01:25:00', new DateTimezone ('America/Bahia'));
$data_c = new DateTime ('2023-04-22 01:25:00', new DateTimezone ('America/Bahia'));

$viagem = new Viagem ($data_s, $data_c, $aeronave, "TA4444", $aeroporto_chegada, $aeroporto_saida);
$viagem2 = new Viagem ($data_s, $data_c, $aeronave, "TA5454", $aeroporto_chegada, $aeroporto_saida);

$passageiro = new Passageiro ();
$passagem = new Passagem (50.0, $viagem, "27D", $passageiro);

// verificar os valores dos atributos do objeto
echo 'Tarifa: ' . $passagem->getTarifa() . "\n";
echo 'Viagem: ' . $passagem->getViagem()->getCodigo() . "\n";
echo 'Assento: ' . $passagem->getAssento() . "\n";
//echo 'Passageiro: ' . $passagem->getPassageiro() . "";
"\n\n";foreach($passagem->getStrStatus() as $status) {
  echo 'Status: ' . $status . "\n";
}
echo "\n";
// alterar os valores dos atributos do objeto
$passagem->setTarifa(55.5);
$passagem->setViagem($viagem2);
$passagem->setAssento("15A");
//$passagem->setPassageiro();
$passagem->setStatus(EnumStatus::Passagem_cancelada);

// verificar os novos valores dos atributos do objeto
echo 'Tarifa: ' . $passagem->getTarifa() . "\n";
echo 'Viagem: ' . $passagem->getViagem()->getCodigo() . "\n";
echo 'Assento: ' . $passagem->getAssento() . "\n";
//echo 'Passageiro: ' . $passagem->getPassageiro() . "\n";
foreach($passagem->getStrStatus() as $status) {
  echo 'Status: ' . $status . "\n";
}
echo "\n";

// testando check-in
$passagem->CheckIn();
echo "\n\n";
foreach($passagem->getStrStatus() as $status) {
  echo 'Status: ' . $status . "\n";
}
echo "\n";