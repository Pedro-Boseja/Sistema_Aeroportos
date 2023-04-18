<?php

// Inclua a classe Cadastro
require_once 'Cadastro.php';

// Crie um objeto Cadastro
$cadastro = new Cadastro(
    'João da Silva', // nome
    'RG',            // documento
    '123.456.789-00',// número CPF
    new DateTime('1990-01-01'), // data de nascimento
    'joao.silva@example.com' // email
);

// Teste os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Documento: ' . $cadastro->getDocumento() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL;

// Teste os métodos setters
$cadastro->setNome('José da Silva');
$cadastro->setIdade(35);
$cadastro->setDocumento('CPF');
$cadastro->setNumeroCpf('987.654.321-00');
$cadastro->setDataNascimento(new DateTime('1988-01-01'));
$cadastro->setEmail('jose.silva@example.com');

// Teste os métodos getters novamente
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Documento: ' . $cadastro->getDocumento() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL;
