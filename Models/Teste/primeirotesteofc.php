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
$aviao = new Aeronave('Embraer', '175', 'PX-RUZ', 180, 600, 6, 30);

// a segunda à Azul.



// Defina a sigla da primeira aeronave como PX-RUZ. Seu código deve validar a sigla e
// tratar a exceção. Em seguida a sigla deve ser corrigida para PP-RUZ.

// Cadastre os aeroportos de Confins, Guarulhos, Congonhas, Galeão e Afonso Pena. Os dados desse aeroporto podem ser encontrados na internet.

// Cadastre o voo AC1329 da Azul ligando os aeroportos de Confins e Guarulhos. 
//Seu código deve validar o código do voo, tratar a exceção e em seguida alterar o código para utilizar a sigla correta da companhia aérea.

// Cadastre dois voos diários de ida e volta, sendo um pela manhã e outro pela tarde, entre os aeroportos abaixo:
// • Confins – Guarulhos
// • Confins – Congonhas
// • Guarulhos – Galeão
// • Congonhas – Afonso Pena

// Com base nos voos cadastrados o sistema deve gerar todas as viagens disponíveis para compra pelos próximos 30 dias.

// Um cliente deve tentar comprar uma passagem para daqui a 60 dias. O sistema deve tratar essa exceção.