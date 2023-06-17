<?php
include_once "../global.php";
//Login
Usuario::Login("Hugo Boss", "1234");

//Companhia aérea:
$azul = new CompanhiaAerea("Azul", 002, "22.111.333/4444-55", "Azul Linhas Aéreas Brasileiras S.A.", "AD", 300);
/*
//Aeroportos;
$confins = new Aeroporto('CNF', 'Confins', 'Minas Gerais');
$guarulhos = new Aeroporto('GRU', 'Guarulhos', 'São Paulo');
$congonhas = new Aeroporto('CGH', 'São Paulo', 'São Paulo');
$galeao = new Aeroporto('GIG', 'Rio de Janeiro', 'Rio de Janeiro');
$afonso = new Aeroporto('CWB', 'São José dos Pinhais', 'Paraná');*/

//Passageiro
$cadastro = new Cadastro(
    'João da Silva', 
    '12.244.876', 
);

$passageiro = new Passageiro(
    $cadastro,
    $DateTime = new DateTime(10/10/2010),
    'Brasileiro', 
    'jaodasirva@orkut.com', 
    '666.666.666-66' 
);

//Progrma de Milhagem
//Cadastrar Passageiro como VIP
$passageiro = $azul->PromoverVIP($passageiro);
echo get_class($passageiro)."\n";

echo $passageiro->verificaPontos()."\n";
$passageiro->addPontos(200, DateTime::createFromFormat('d/m/Y', '19/06/2024'));
echo $passageiro->verificaPontos()."\n";
$passageiro->addPontos(300);
echo $passageiro->verificaPontos()."\n";

$m = $azul->getMilhagem();
$azul->CadastrarCategoria("vERDE", 100);
$m->Upgrade($passageiro);
echo $m->imprimeCategoria(200)."\n";
echo $m->getCategoriaPassageiro($passageiro)."\n";

