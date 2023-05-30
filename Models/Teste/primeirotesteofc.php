<?php

include_once "../Models/global.php";

// Cadastre duas companhias aéreas:
// • Nome: Latam
// • Código: 001
// • Razão Social: Latam Airlines do Brasil S.A.
// • CNPJ: 11.222.333/4444-55
// • Sigla: LA
$companhia1 = new CompanhiaAerea("Latam", 001, "11.222.333/4444-55", "Latam Airlines do Brasil S.A.", "LA");


// • Nome: Azul
// • Código: 002
// • Razão Social: Azul Linhas Aéreas Brasileiras S.A.
// • CNPJ: 22.111.333/4444-55
// • Sigla: AD
$companhia2 = new CompanhiaAerea("Azul", 002, "22.111.333/4444-55", "Azul Linhas Aéreas Brasileiras S.A.", "AD");

// Cadastre duas aeronaves 
//modelo 175 
// fabricante Embraer, 
// com capacidade de 180 passageiros 
// 600 kg de carga. 
// A primeira aeronave deve pertencer a Latam 
// Defina a sigla da primeira aeronave como PX-RUZ.
$aviao = new Aeronave('Embraer', '175', 'PX-RUZ', 180, 600, 6, 30);

// Seu código deve validar a sigla e tratar a exceção. Em seguida a sigla deve ser corrigida para PP-RUZ.


$companhia1->CadastrarAeronave($aviao1);

// a segunda à Azul.
$aviao2 = new Aeronave('Azul', '175', 'PP-RUZ', 180, 600, 6, 30);
$companhia2->CadastrarAeronave($aviao2);

// Cadastre os aeroportos de Confins, Guarulhos, Congonhas, Galeão e Afonso Pena. Os dados desse aeroporto podem ser encontrados na internet.
$aeroporto1 = new Aeroporto('CNF', 'Confins', 'Minas Gerais');
$aeroporto2 = new Aeroporto('GRU', 'Guarulhos', 'São Paulo');
$aeroporto3 = new Aeroporto('CGH', 'São Paulo', 'São Paulo');
$aeroporto4 = new Aeroporto('GIG', 'Rio de Janeiro', 'Rio de Janeiro');
$aeroporto5 = new Aeroporto('CWB', 'São José dos Pinhais', 'Paraná');

// Cadastre o voo AC1329 da Azul ligando os aeroportos de Confins e Guarulhos. 
$voo1 = new Viagem($a = new DateTime(), $b = new DateTime(), 'AC1329', $aeroporto2, $aeroporto1, $companhia2);

//Seu código deve validar o código do voo, tratar a exceção e em seguida alterar o código para utilizar a sigla correta da companhia aérea.


// Cadastre dois voos diários de ida e volta, sendo um pela manhã e outro pela tarde, entre os aeroportos abaixo:
// • Confins – Guarulhos
// • Confins – Congonhas
// • Guarulhos – Galeão
// • Congonhas – Afonso Pena

// Com base nos voos cadastrados o sistema deve gerar todas as viagens disponíveis para compra pelos próximos 30 dias.
//utilizando aeronaves previamente cadastradas no sistema.

// Um cliente deve realizar a compra da passagem somente de ida para um passageiro Vip
// para amanhã (essa data deve ser um parâmetro no código de testes), entre os
// aeroportos de Confins (Belo Horizonte-MG) e Afonso Pena (Curitiba-PR). Esse passageiro
// deve ser previamente cadastrado. Ele faz parte do Programa de Milhagem da Azul. Os
// vôos de ida devem ser da Azul.
// Deve ser feito o checkin da passagem e os cartões de embarque gerados e impressos na
// tela.
// Feito isto, simule a realização das viagens envolvidas.
// Deve ser adquirida também uma passagem de volta em pelo menos um vôo da Latam
// dois dias após a ida. Deve-se tentar fazer checkin dessa passagem.
// Logo após essa passagem deve ser cancelada. Os valores de ressarcimento devem ser
// calculados e exibidos na tela.
// Cadastre e planeje a tripulação que atuará na primeira viagem do vôo de ida do
// passageiro. A rota da van que vai buscar a tripulação para a realização da viagem
// também deve ser planejada. Os horários em que cada tripulante embarca na van devem
// ser exibidos.
// Ao final todos os logs das operações realizadas devem ser exibidos na tela.