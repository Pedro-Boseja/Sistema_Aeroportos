<?php

include_once "../global.php";

Usuario::Login("Hugo Boss", "1234");

// criar um objeto da classe Viagem
$date_s = new DateTime('11-09-2001 15:45', new DateTimeZone('America/Bahia'));
$date_c = new DateTime('11-09-2023 15:46', new DateTimeZone('America/Bahia'));

$aeronave = new Aeronave ("AvioesTalita", "AeroTalit3000", "TA-LIT", 180, 10000.7, 4, 6);

$aeroporto_saida = new Aeroporto ("CNF", "Belo Horizonte", "Minas Gerais");
$aeroporto_chegada = new Aeroporto ("GUA", "Guarulhos", "Sao Paulo");

$viagem = new Viagem($date_s, $date_c, $aeronave, "TA444", $aeroporto_saida, $aeroporto_chegada);

$companhia = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AZL");

$cadastro = new Cadastro('João da Silva', '12.244.876');

$tripulante1 = new Tripulante($cadastro, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua dos Piratas, 99 - Centro, Caribe-CA, Haiti', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante2 = new Tripulante($cadastro, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Antonino Abreu França, São Cristovao 2, Sete Lagoas - MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante3 = new Tripulante($cadastro, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Joao Fernandes, 113 - Liberdade, Belo Horizonte - MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante4 = new Tripulante($cadastro, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Santo Antonio, 27, Itutinga - MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulação = array();
array_push($tripulação, $tripulante1, $tripulante2, $tripulante3, $tripulante4);

$viagem->addTripulacao($tripulacao);

$veiculo = new Veiculo (12, 18.0, $viagem);

echo "\n";
echo $veiculo->getCapacidade() . "\n";
echo $veiculo->getVMedia() . "\n";

$endereço1 = "Sete Lagoas, MG, Rua Maria Ferreira Saraiva, 57";
$endereço2 = "Belo Horizonte, MG, Rua João Fernandes, 113";

$distancia = $veiculo->CalculaDistancia($endereço1, $endereço2);

echo "A distância entre os dois endereços dados é de " . $distancia . " kilometros\n";

$rota = $veiculo->CalculaRota($viagem);
$dtotal = $veiculo->CalculaDTotal();
$tempo = $veiculo->CalculaTempo();
$horarios = $veiculo->CalculaHorariosEmbarque();
