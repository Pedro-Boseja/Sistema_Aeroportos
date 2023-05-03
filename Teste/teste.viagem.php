<?php

include_once '../Classes/class.aeronave.php';
include_once '../Classes/class.aeroporto.php';
include_once '../Classes/class.passageiro.php';
include_once '../Classes/class.passagem.php';
include_once '../Classes/class.cadastro.php';
include_once '../Classes/class.viagem.php';


// criar um objeto da classe Viagem
$date_s = new DateTime('11-09-2001 15:45', new DateTimeZone('America/Bahia'));
$date_c = new DateTime('11-09-2023 15:46', new DateTimeZone('America/Bahia'));

$date_s1 = new DateTime('11-09-2001 15:40', new DateTimeZone('America/Bahia'));
$date_c2 = new DateTime('11-10-2001 15:46', new DateTimeZone('America/Bahia'));

$aeronave = new Aeronave ("AvioesTalita", "AeroTalit3000", "TA-LIT", 180, 10000.7, 4, 6);

$aeronave1 = new Aeronave ("AvioesRM", "AeroRM2000", "RM-MOS", 180, 10000.7, 6, 4);

$aeroporto_saida = new Aeroporto ("CNF", "Belo Horizonte", "Minas Gerais");
$aeroporto_chegada = new Aeroporto ("GUA", "Guarulhos", "Sao Paulo");

$aeroporto_saida1 = new Aeroporto ("CNF", "Bel Zonte", "Minas Gerais");
$aeroporto_chegada1 = new Aeroporto ("GUA", "Gua", "Sao Paulo");

$viagem = new Viagem($date_s, $date_c, $aeronave, "TA444", $aeroporto_saida, $aeroporto_chegada);

$cadastro = new Cadastro ("Talita", "RG", "111", "111.111.111-11", $date_s1, "ta@g.com");
$passageiro = new Passageiro ($cadastro);
$passagem = new Passagem (50.0, $viagem, "27D", $passageiro);

// verificar os valores dos atributos do objeto
echo 'Data de saída: ' . $viagem->getDataS()->format('d-m-y H:i') . "\n";
echo 'Data de chegada: ' . $viagem->getDataC()->format('d-m-y H:i') . "\n";
echo 'Duracao: ' . $viagem->getDuracao()->format("%H:%I:%S (Full days: %a)") . "\n";
echo 'Código da viagem: ' . $viagem->getCodigo() . "\n";
echo 'Aeroporto de saída: ' . $viagem->getAeroportoSaida() . "\n";
echo 'Aeroporto de chegada: ' . $viagem->getAeroportoChegada() . "\n";
echo 'Assentos livres: ';
$a = array_keys($viagem->getAssentosLivres());
foreach($a as $al){
    echo "$al" . "\n";
}
echo "\n";
echo 'Execução: ';
if ($viagem->getExecutado() == 0) {
    echo "viagem não executada.\n";
}
else {
    echo "viagem executada.\n";
}
echo "\n";

$viagem->setDates($date_s1, $date_c2);
$viagem->setAeronave($aeronave1);
$viagem->setAeroportoSaida($aeroporto_saida1);
$viagem->setAeroportoChegada($aeroporto_chegada1);
$viagem->ViagemExecutada();


echo 'Data de saída: ' . $viagem->getDataS()->format('d-m-y H:i') . "\n";
echo 'Data de chegada: ' . $viagem->getDataC()->format('d-m-y H:i') . "\n";
echo 'Duracao: ' . $viagem->getDuracao()->format("%H:%I:%S (Full days: %a)") . "\n";
echo 'Código da viagem: ' . $viagem->getCodigo() . "\n";
echo 'Aeroporto de saída: ' . $viagem->getAeroportoSaida() . "\n";
echo 'Aeroporto de chegada: ' . $viagem->getAeroportoChegada() . "\n";
echo 'Assentos livres: ';
$a = array_keys($viagem->getAssentosLivres());
foreach($a as $al){
    echo "$al" . "\n";
}
echo "\n";
echo 'Os assentos 1A, 1B e 4D foram comprados';
echo "\n";

$viagem->addPassagem("1A", $passagem);
$viagem->addPassagem("1B", $passagem);
$viagem->addPassagem("4D", $passagem);

echo "\n";

echo 'Assentos livres: ';
$a = array_keys($viagem->getAssentosLivres());
foreach($a as $al){
    echo "$al" . "\n";
}
echo "\n";
echo 'Execução: ';
if ($viagem->getExecutado() == 0) {
    echo "viagem não executada.\n";
}
else {
    echo "viagem executada.\n";
}
echo "\n";