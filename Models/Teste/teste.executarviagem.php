<?php

include_once "../global.php";

//Tentando usar funcionalidades sem estar logado
try{
    new CompanhiaAerea("Latam", 001, "11.222.333/4444-55", "Latam Airlines do Brasil S.A.", "LA", 300);
}catch(Exception $e){
    echo $e->getMessage();
}

Usuario::Login("Hugo Boss", "1234");

// Cadastre duas companhias aéreas:

// • Nome: Latam
// • Código: 001
// • Razão Social: Latam Airlines do Brasil S.A.
// • CNPJ: 11.222.333/4444-55
// • Sigla: LA
$latam = new CompanhiaAerea("Latam", 001, "11.222.333/4444-55", "Latam Airlines do Brasil S.A.", "LA", 300);
$latam->save();
// • Nome: Azul
// • Código: 002
// • Razão Social: Azul Linhas Aéreas Brasileiras S.A.
// • CNPJ: 22.111.333/4444-55
// • Sigla: AD
$azul = new CompanhiaAerea("Azul", 002, "22.111.333/4444-55", "Azul Linhas Aéreas Brasileiras S.A.", "AD", 300);
$latam->save();
// Cadastre duas aeronaves 
//modelo 175 
// fabricante Embraer, 
// com capacidade de 180 passageiros 
// 600 kg de carga. 
// A primeira aeronave deve pertencer a Latam 
// Defina a sigla da primeira aeronave como PX-RUZ.
// Seu código deve validar a sigla e tratar a exceção. Em seguida a sigla deve ser corrigida para PP-RUZ.
try{
    $aviao1 = new Aeronave('Embraer', '175', 'PX-RUZ', 180, 600, 6, 10);
}catch(Exception $e){
    echo $e->getMessage();
}
$aviao1 = new Aeronave('Embraer', '175', 'PP-RUZ', 180, 600, 6, 10);



$latam->CadastrarAeronave($aviao1);

// a segunda à Azul.
$aviao2 = new Aeronave('Azul', '175', 'PP-RUZ', 180, 600, 6, 10);
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
$plano1->ProgramaViagens();
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
// Com base nos voos cadastrados o sistema deve gerar todas as viagens disponíveis para compra pelos próximos 30 dias.
//utilizando aeronaves previamente cadastradas no sistema.
$data1 = Datetime::createFromFormat('H:i', "11:00");
$data2 = Datetime::createFromFormat('H:i', "13:00");
$data3 = Datetime::createFromFormat('H:i', "09:00");
$data4 = Datetime::createFromFormat('H:i', "20:00");
$data5 = Datetime::createFromFormat('H:i', "22:00");
$data6 = Datetime::createFromFormat('H:i', "08:00");
$data7 = Datetime::createFromFormat('H:i', "19:00");
$data8 = Datetime::createFromFormat('H:i', "15:20");
$data9 = Datetime::createFromFormat('H:i', "18:30");
//confins - congonhas
$cnf_cgh = new PLanejamento($freq, "CNF-CGH",$confins, $congonhas, $data1, $data2, 200, $azul);
$cnf_cgh->ProgramaViagens();
//congonhas - confins 
$cgh_cnf = new PLanejamento($freq, "CGH-CNF",$congonhas,$confins, $data4, $data5, 300, $azul);
$cgh_cnf->ProgramaViagens();

//confins - guarulhos
$cnf_gru = new PLanejamento($freq, "CNF-GRU",$confins, $guarulhos, $data6, $data1, 500, $azul);
$cnf_gru->ProgramaViagens();
//guarulhos - confins 
$gru_cnf = new PLanejamento($freq, "GRU-CNF",$guarulhos ,$confins, $data7, $data5, 600, $azul);
$gru_cnf->ProgramaViagens();

//guarulhos - galeão
$gru_gig = new PLanejamento($freq, "CNF-GIG",$guarulhos, $galeao, $data6, $data1, 500, $azul);
$gru_gig->ProgramaViagens();
//galeão - guarulhos
$gig_gru = new PLanejamento($freq, "GIG-CNF",$galeao, $guarulhos, $data7, $data5, 500, $azul);
$gig_gru->ProgramaViagens();

//congonhas - afonso pena
$cgh_cwb = new PLanejamento($freq, "CGH-CWB",$congonhas,$afonso, $data8, $data9, 300, $azul);
$cgh_cwb->ProgramaViagens();
//afonso pena - congonhas
$cwb_cgh = new PLanejamento($freq, "CWB-CGH",$congonhas,$afonso, $data7, $data5, 300, $azul);
$cwb_cgh->ProgramaViagens();

$cbw_cnf = new PLanejamento($freq, "CWB-CNF",$afonso,$confins, $data7, $data5, 300, $latam);
$cbw_cnf->ProgramaViagens();


// Um cliente deve realizar a compra da passagem somente de ida para um passageiro Vip
// para amanhã (essa data deve ser um parâmetro no código de testes), entre os
// aeroportos de Confins (Belo Horizonte-MG) e Afonso Pena (Curitiba-PR). Esse passageiro
// deve ser previamente cadastrado. Ele faz parte do Programa de Milhagem da Azul. Os
// vôos de ida devem ser da Azul.
$cliente = new Cliente("Enzo Magno", "02053702176");


$cadPassageiro = new Cadastro("Ramon Espanhol", "CPF");
$nascimento = DateTime::createFromFormat("d/m/Y", "31/03/2004");
$passageiro = new Passageiro($cadPassageiro, $nascimento, "brasileiro", "ramo@magno.com", "12314525877");


$azul->CadastrarCategoria("ouro", "1000");
$azul->CadastrarCategoria("diamante", "2000");
$azul->CadastrarCategoria("platina", "3000");
$passageiro = $azul->PromoverVIP($passageiro);


$datacliente = DateTime::createFromFormat("d/m/Y", "17/06/2023");

$lista_viagens = $cliente->SolicitarViagem($confins, $afonso, $datacliente, 1);
$viagem_escolhida = $cliente->EscolherViagem($lista_viagens, 0);
// $cliente->EscolherAssentos($viagem_escolhida);
$cliente->ComprarPassagem($viagem_escolhida, $passageiro, ["A1", "A2"], 1);

//Logando com Outro Usuário:
Usuario::Sair();
Usuario::Login("Enzo Magico", "696969");

// Cadastre e planeje a tripulação que atuará na primeira viagem do vôo de ida do
// passageiro.

$cad1 = new Cadastro("José", "RG");
$cad2 = new Cadastro("Maria", "RG");
$cad3 = new Cadastro("Dalton", "RG");
$cad4 = new Cadastro("Erica", "RG");


$piloto = new Piloto($cad1, DateTime::createFromFormat("d/m/Y","25/11/1982"), "brasileiro", "jmaldade@gmail.com", 
                        "RG", "Av. do Contorno", $azul, $confins, "000.000.070-67" );

$copiloto = new Piloto($cad2, DateTime::createFromFormat("d/m/Y","03/04/1983"), "brasileira", "malvadeza@gmail.com", 
                        "RG", "Av. Antonio Carlos", $azul, $confins, "100.000.090-98" );

$comissario1 = new Comissario($cad3, DateTime::createFromFormat("d/m/Y","21/04/1995"), "brasileiro", "dtca@gmail.com", 
                        "RG", "Alameda das Falcatas", $azul, $confins, "970.030.100-08" );

$comissario2 = new Comissario($cad4, DateTime::createFromFormat("d/m/Y","15/09/1993"), "brasileira", "ricare@gmail.com", 
                        "RG", "Rua João Fernandes", $azul, $confins, "088.430.000-79" );


$tripulacao = array ();

$tripulacao = [$piloto, $copiloto, $comissario1, $comissario2];

$azul->CadastrarPiloto($piloto);
$azul->CadastrarPiloto($copiloto);
$azul->CadastrarComissario($comissario1);
$azul->CadastrarComissario($comissario2);

$viagem_escolhida[0]->setAeronave($aviao2);
$viagem_escolhida[1]->setAeronave($aviao2);

$viagem_escolhida[0]->AddTripulaçao($tripulacao);
$viagem_escolhida[1]->AddTripulaçao($tripulacao);


// A rota da van que vai buscar a tripulação para a realização da viagem
// também deve ser planejada. Os horários em que cada tripulante embarca na van devem
// ser exibidos.

// Deve ser feito o checkin da passagem e os cartões de embarque gerados e impressos na
// tela.
$passageiro->getPassagem()->CheckIn();
$passageiro->getPassagem()->PrintCartaoEmbarque();

// Feito isto, simule a realização das viagens envolvidas.


// Deve ser adquirida também uma passagem de volta em pelo menos um vôo da Latam
// dois dias após a ida. Deve-se tentar fazer checkin dessa passagem.
$datacliente2 = DateTime::createFromFormat("d/m/Y", "25/06/2023");
$lista_viagens = $cliente->SolicitarViagem($afonso, $confins, $datacliente2, 1);
$viagem_escolhida = $cliente->EscolherViagem($lista_viagens, 0);
// $cliente->EscolherAssentos($viagem_escolhida);
$cliente->ComprarPassagem($viagem_escolhida, $passageiro, ["10E"], 1);

try{
    $passageiro->getPassagem()->CheckIn();
}catch(Exception $e){
    echo $e->getMessage();
}


// Logo após essa passagem deve ser cancelada. Os valores de ressarcimento devem ser
// calculados e exibidos na tela.
//$passageiro->getPassagem()->CancelarPassagem();
echo "Antes entrar na func";
//$viagem_escolhida->ViagemExecutada();
//print_r($viagem_escolhida->getPassageiros());
$passagem = $passageiro->getPassagem();
$v = $passagem->getViagens();
//$passa = $v[0]->getPassageiros();
//print_r($passa);
//print_r($v);
echo count($companhia = CompanhiaAerea::getRecordsByField("_sigla", $v[0]->getCompanhia()))."\n";
//print_r($passageiro);
echo $passageiro->verificaPontos();
$v[0]->ExecutarViagem();
echo count($latam->getPLanejamentos());
