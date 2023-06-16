<?php

include_once "../global.php";

//Tentando usar funcionalidades sem estar logado
echo 'teste 1';
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
// Seu código deve validar a sigla e tratar a exceção. Em seguida a sigla deve ser corrigida para PP-RUZ.
echo 'teste 2';
try{
    $aviao1 = new Aeronave('Embraer', '175', 'PX-RUZ', 180, 600, 6, 30);
}catch(Exception $e){
    echo $e->getMessage();
}
$aviao1 = new Aeronave('Embraer', '175', 'PP-RUZ', 180, 600, 6, 30);



$latam->CadastrarAeronave($aviao1);

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
echo 'teste 3';
try{
    $plano1->createViagem("AC1329", new DateTime());
}catch(Exception $e){
    echo $e->getMessage();
}
$plano1->createViagem("AD1329", new DateTime());
/*


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
$data8 = Datetime::createFromFormat('H:i', "15:20");
$data9 = Datetime::createFromFormat('H:i', "16:30");

//confins - guarulhos
$cnf_cgh = new PLanejamento($freq, "CNF-CGH",$confins, $congonhas, $data1, $data2, 20, $azul);
$cgh_cwb = new PLanejamento($freq, "CGH-CWB",$congonhas,$afonso, $data8, $data9, 30, $azul);

#$cgh_cwb->ProgramaViagens();

$cnf_cgh->ProgramaViagens();
//Passageiro
// cria um cadastro inicial*/
$cadastro = new Cadastro(
    'João da Silva', // nome
    '12.244.876', //numero documento
);

$passageiro = new Passageiro(
    $cadastro, // nome e documento
    $DateTime = new DateTime(10/10/2010), // data de nascimento
    'Brasileiro', // nacionalidade
    'jaodasirva@orkut.com', // e-mail
    '666.666.666-66' // cpf
);
//Progrma de Milhagem
$passageiro = $azul->PromoverVIP($passageiro);
echo get_class($passageiro)."\n";
$azul->CadastrarPassageiroVip($passageiro);

echo $passageiro->verificaPontos()."\n";
$passageiro->addPontos(200, DateTime::createFromFormat('d/m/Y', '19/06/2024'));
echo $passageiro->verificaPontos();

$m = $azul->getMilhagem();
$azul->CadastrarCategoria("vERDE", 100);
$m->Upgrade($passageiro);
echo $m->imprimeCategoria(200);
echo $m->getPassageiros();

//Fim
$data_partida = DateTime::createFromFormat('d/m/Y', '19/06/2023');

/*try{
    $viagens = Facade::SolicitarViagem($confins, $congonhas, $data_partida, 2);
}catch(Exception $e){
    echo $e->getMessage();
}


echo "________________________________________\n";
 foreach ($viagens as $viagem){

          
          echo $viagem->getCodigo();
          echo " -> \n";
          echo $viagem->getAeroportoSaida();
          echo ": ";
          echo $viagem->getDataS()->format('m-d h:i');
          echo "\n";

          echo $viagem->getAeroportoChegada();
          echo ": ";
          echo $viagem->getDataC()->format('m-d h:i');
          echo "\n";
          echo "\n";
          
    }*//*
    $cliente = new Cliente('João da Silva','12.244.876');
    $viagens = $cliente->SolicitarViagem($confins, $congonhas, $data_partida, 2);
    $cliente->ComprarPassagem($viagens[0], $passageiro, 1, 2);
    //$viagens[0]->getCodigo();
    #echo strval($passageiro->verificaPontos());
    Facade::ComprarPassagem($cod,$passageiro,8, 1);
    
    //$viagens[0]->ViagemExecutada();
    $passageiro->verificaPontos();*/

