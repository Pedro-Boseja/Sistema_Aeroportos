<?php

include_once ('../classes/class.tripulante.php');
include_once 'persist.php';

$aeroporto = new Aeroporto('GRU', 'São Paulo', 'SP');

$aeroporto2 = new Aeroporto('CNF', 'Belo Horizonte', 'MG');

$companhia = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AZL");

$companhia2 = new CompanhiaAerea("Gol Linhas Aéreas", 456, "23.456.789/0001-02", "Gol S.A.", "GOL");

$cadastro = new Cadastro(
    'João da Silva', // nome
    '12.244.876', //numero documento
);

$cadastro->fillPassageiro(
    $DateTime = new DateTime(10/10/2010), // data de nascimento
    'Brasileiro', // nacionalidade
    'jaodasirva@orkut.com', // email
    '666.666.666-66' // cpf
);

$tripulante = new Tripulante(
    $cadastro, // cadastro
    $DateTime = new DateTime(10/10/2010), // data de nascimento
    'Brasileiro', // nacionalidade
    'jaodasirva@orkut.com', // email
    '54321', // cht
    'Rua dos Piratas, 99 - Centro, Caribe-CA, Haiti', // endereço
    $companhia,// companhia
    $aeroporto,// aeroporto
    '666.666.666-66' // cpf
);

// Testa os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'RG: ' . $cadastro->getDocumento("RG") . PHP_EOL;
echo 'PASSAPORTE: ' . $cadastro->getDocumento("PASSAPORTE") . PHP_EOL;
echo 'CHT: ' . $cadastro->getDocumento("CHT") . PHP_EOL;
echo 'Nacionalidade: ' . $cadastro->getNacionalidade() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL;
echo 'Endereço: ' . $cadastro->getEndereco() . PHP_EOL;
echo 'Companhia Aérea: ' . $tripulante->getCompanhia() . PHP_EOL;
echo 'Aeroporto Base: ' . $tripulante->getAeroporto() . PHP_EOL;
echo "\n";

// Testa os métodos setters
$cadastro->setNome('Bruno Cimbler');
$cadastro->setDocumento('12.345.678');
$cadastro->setNacionalidade('zimbabueano');
$cadastro->setNumeroCpf('987.654.321-00');
$cadastro->setDataNascimento(new DateTime('1969-01-01'));
$cadastro->setEmail('brunin.games@example.com');
$cadastro->setEndereco('Rua Constantinopla. 666 - Cracolandia, Espirito Sanri - ES, Zimbabue');
$tripulante->setCompanhia($companhia2);
$tripulante->setAeroporto($aeroporto2);

// Testa os métodos getters novamente
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'RG: ' . $cadastro->getDocumento("RG") . PHP_EOL;
echo 'PASSAPORTE: ' . $cadastro->getDocumento("PASSAPORTE") . PHP_EOL;
echo 'CHT: ' . $cadastro->getDocumento("CHT") . PHP_EOL;
echo 'Nacionalidade: ' . $cadastro->getNacionalidade() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL;
echo 'Endereço: ' . $cadastro->getEndereco() . PHP_EOL;
echo 'Companhia Aérea: ' . $tripulante->getCompanhia() . PHP_EOL;
echo 'Aeroporto Base: ' . $tripulante->getAeroporto() . PHP_EOL;
echo "\n";