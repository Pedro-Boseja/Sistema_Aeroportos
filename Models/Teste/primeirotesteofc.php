<?php

include_once "../Models/global.php";

<<<<<<< Updated upstream
=======
//Tentando usar funcionalidades sem estar logado
try{
    new CompanhiaAerea("Latam", 001, "11.222.333/4444-55", "Latam Airlines do Brasil S.A.", "LA", 300);
}catch(Exception $e){
    echo $e->getMessage();
}

Usuario::Login("Hugo Boss", "1234");

>>>>>>> Stashed changes
// Cadastre duas companhias aéreas:

// • Nome: Latam
// • Código: 001
// • Razão Social: Latam Airlines do Brasil S.A.
// • CNPJ: 11.222.333/4444-55
// • Sigla: LA
$latam = new CompanhiaAerea("Latam", 001, "11.222.333/4444-55", "Latam Airlines do Brasil S.A.", "LA", 300);

// • Nome: Azul
// • Código: 002
// • Razão Social: Azul Linhas Aéreas Brasileiras S.A.
// • CNPJ: 22.111.333/4444-55
// • Sigla: AD
$azul = new CompanhiaAerea("Azul", 002, "22.111.333/4444-55", "Azul Linhas Aéreas Brasileiras S.A.", "AD", 300);

// Cadastre duas aeronaves 
//modelo 175 
// fabricante Embraer, 
// com capacidade de 180 passageiros 
// 600 kg de carga. 
// A primeira aeronave deve pertencer a Latam 
// Defina a sigla da primeira aeronave como PX-RUZ.
try{
    $aviao = new Aeronave('Embraer', '175', 'PX-RUZ', 180, 600, 6, 30);
}catch(Exception $e){
    $aviao = new Aeronave('Embraer', '175', 'PP-RUZ', 180, 600, 6, 30);
}
// Seu código deve validar a sigla e tratar a exceção. Em seguida a sigla deve ser corrigida para PP-RUZ.

<<<<<<< Updated upstream
$companhia1->CadastrarAeronave($aviao1);
=======

$latam->CadastrarAeronave($aviao1);
>>>>>>> Stashed changes

// a segunda à Azul.
$aviao2 = new Aeronave('Azul', '175', 'PP-RUZ', 180, 600, 6, 30);
$azul->CadastrarAeronave($aviao2);

// Cadastre os aeroportos de Confins, Guarulhos, Congonhas, Galeão e Afonso Pena. Os dados desse aeroporto podem ser encontrados na internet.
$confins = new Aeroporto('CNF', 'Confins', 'Minas Gerais');
$guarulhos = new Aeroporto('GRU', 'Guarulhos', 'São Paulo');
$congonhas = new Aeroporto('CGH', 'São Paulo', 'São Paulo');
$galeao = new Aeroporto('GIG', 'Rio de Janeiro', 'Rio de Janeiro');
$afonso = new Aeroporto('CWB', 'São José dos Pinhais', 'Paraná');

// Cadastre o voo AC1329 da Azul ligando os aeroportos de Confins e Guarulhos.
//Seu código deve validar o código do voo, tratar a exceção e em seguida alterar o código para utilizar a sigla correta da companhia aérea.
$freq = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$datas = Datetime::createFromFormat('H:i', "11:00");
$datac = Datetime::createFromFormat('H:i', "13:00");
$plano1 = new PLanejamento($freq, "CNF-GRU", $confins, $guarulhos, $datas, $datac, 60, $azul);
$azul->addPlanejamento($plano1);

try{
    $plano1->createViagem("AC1329", new DateTime());
}catch(Exception $e){
    echo $e->getMessage();
}
$plano1->createViagem("AD1329", new DateTime());



// Cadastre dois voos diários de ida e volta, sendo um pela manhã e outro pela tarde, entre os aeroportos abaixo:
// • Confins – Guarulhos
// • Confins – Congonhas
// • Guarulhos – Galeão
// • Congonhas – Afonso Pena
$data1 = Datetime::createFromFormat('H:i', "11:00");
$data2 = Datetime::createFromFormat('H:i', "13:00");
$data3 = Datetime::createFromFormat('H:i', "09:00");
$data4 = Datetime::createFromFormat('H:i', "20:00");
$data5 = Datetime::createFromFormat('H:i', "22:00");
$data6 = Datetime::createFromFormat('H:i', "08:00");
$data7 = Datetime::createFromFormat('H:i', "19:00");

//confins - congonhas
$cnf_cgh = new PLanejamento($freq, "CNF-CGH",$confins, $congonhas, $data1, $data2, 20, $latam);
// $cnf_cgh->ProgramaViagens();
//congonhas - confins 
$cgh_cnf = new PLanejamento($freq, "CGH-CNF",$congonhas,$confins, $data4, $data5, 30, $latam);
// $cgh_cnf->ProgramaViagens();

//confins - guarulhos
$cnf_gru = new PLanejamento($freq, "CNF-GRU",$confins, $guarulhos, $data6, $data1, 50, $latam);
// $cnf_gru->ProgramaViagens();
//guarulhos - confins 
$gru_cnf = new PLanejamento($freq, "GRU-CNF",$guarulhos ,$confins, $data7, $data5, 60, $latam);
// $gru_cnf->ProgramaViagens();

//guarulhos - galeão
$gru_gig = new PLanejamento($freq, "CNF-GIG",$guarulhos, $galeao, $data6, $data1, 50, $latam);
// $gru_gig->ProgramaViagens();
//galeão - guarulhos
$gig_gru = new PLanejamento($freq, "GIG-CNF",$galeao, $guarulhos, $data7, $data5, 50, $latam);
// $gig_gru->ProgramaViagens();

//congonhas - afonso pena
$cgh_cwb = new PLanejamento($freq, "CGH-CWB",$congonhas,$afonso, $data4, $data5, 30, $latam);
// $cgh_cwb->ProgramaViagens();
//afonso pena - congonhas
$cwb_cgh = new PLanejamento($freq, "CWB-CGH",$congonhas,$afonso, $data7, $data5, 30, $latam);
// $cwb_cgh->ProgramaViagens();
$latam->atualizaViagens();


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