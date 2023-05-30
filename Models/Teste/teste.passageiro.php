<?php

include_once "../global.php";

// cria um cadastro inicial
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

// Testa os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'RG: ' . $cadastro->getDocumento("RG") . PHP_EOL;
echo 'PASSAPORTE: ' . $cadastro->getDocumento("PASSAPORTE") . PHP_EOL;
echo 'CHT: ' . $cadastro->getDocumento("CHT") . PHP_EOL;
echo 'Nacionalidade: ' . $cadastro->getNacionalidade() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL ;
echo "\n";

// Testa os métodos setters
$cadastro->setNome('Bateus Mastos');
$cadastro->setDocumento('12.345.678');
$cadastro->setNacionalidade('MEXICANO');
$cadastro->setNumeroCpf('987.654.321-00');
$cadastro->setDataNascimento(new DateTime('1988-01-01'));
$cadastro->setEmail('jose.silva@example.com');

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
echo "\n";