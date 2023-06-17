<?php

include_once "../global.php";

Usuario::Login("Hugo Boss", "1234");

// criar um objeto da classe Viagem
$date_s = new DateTime('11-09-2001 15:45', new DateTimeZone('America/Bahia'));
$date_c = new DateTime('11-09-2023 15:46', new DateTimeZone('America/Bahia'));

$companhia = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AD", 23.0);
//$aeronave = new Aeronave ("AvioesTalita", "AeroTalit3000", "PT-TALITA", 180, 10000.7, 4, 6);

$aeroporto_saida = new Aeroporto ("CNF", "Belo Horizonte", "Minas Gerais");
$aeroporto_chegada = new Aeroporto ("GUA", "Guarulhos", "Sao Paulo");

$aviao = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5, 6, 30);

$viagem = new Viagem($date_s, $date_c, "TA444", $aeroporto_saida, $aeroporto_chegada, $companhia, $aviao, 20.0);

$cadastro1 = new Cadastro('João da Silva', '12.244.876');
$cadastro2 = new Cadastro('João da Costa', '12.244.876');
$cadastro3 = new Cadastro('Maria da Silva', '12.244.876');
$cadastro4 = new Cadastro('Maria da Costa', '12.244.876');

$tripulante1 = new Tripulante($cadastro1, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Antonio Abreu França, Sete Lagoas, MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante2 = new Tripulante($cadastro2, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Maria Ferreira Saraiva, 57, Sete Lagoas, MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante3 = new Tripulante($cadastro3, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Joao Fernandes, 113, Belo Horizonte, MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulante4 = new Tripulante($cadastro4, $DateTime = new DateTime(10/10/2010),'Brasileiro', 'jaodasirva@orkut.com', '54321','Rua Santo Antonio, 27, Itutinga, MG, Brasil', $companhia, $aeroporto_saida, '666.666.666-66'); 

$tripulação = array();
array_push($tripulação, $tripulante1, $tripulante2, $tripulante3, $tripulante4);

$viagem->addTripulaçao($tripulação);

$veiculo = new Veiculo (12, 18.0, $viagem);

echo "\n";
echo "capacidade: " . $veiculo->getCapacidade() . "\n";
echo "velocidade média: " . $veiculo->getVMedia() . "\n";

$rota = $veiculo->CalculaRota($viagem);
$dtotal = $veiculo->CalculaDTotal();
echo "Distancia total: " . $dtotal . "\n";
$tempo = $veiculo->CalculaTempo($dtotal);
echo "Tempo gasto: " . $tempo . "\n";
$horarios = $veiculo->CalculaHorariosEmbarque();
