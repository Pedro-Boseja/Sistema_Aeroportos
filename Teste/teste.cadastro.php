<?php

// Inclua a classe Cadastro
include_once '../Classes/class.cadastro.php';

// Crie um objeto Cadastro simples (cliente)
$cadastro = new Cadastro(
    'João da Silva', // nome
    '12.244.876', //numero documento
);

// Teste os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'Documento: ' . $cadastro->getDocumento("RG") . PHP_EOL;
echo "\n";

// Teste os métodos setters
$cadastro->setNome('José da Silva');
$cadastro->setDocumento('PASSAPORTE');

// Teste os métodos getters novamente
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'Documento: '; 
for ($i = 0; $i < 3; $i++) {
    echo $cadastro->getDocumento($i) . "/n";
}
echo PHP_EOL;
echo 'Nacionalidade: ' . $cadastro->getNacionalidade() . PHP_EOL;
echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
echo 'Email: ' . $cadastro->getEmail() . PHP_EOL;
echo 'Endereço: ' . $cadastro->getEndereco() . PHP_EOL;

// Completa um cliente para passageiro

    //'123.456.789-00',// número CPF
    //new DateTime('1990-01-01'), // data de nascimento
    //'joao.silva@example.com' // email
    
//echo 'Idade: ' . $cadastro->getIdade() . PHP_EOL;
//echo 'Número CPF: ' . $cadastro->getNumeroCpf() . PHP_EOL;
//echo 'Data de nascimento: ' . $cadastro->getDataNascimento()->format('d/m/Y') . PHP_EOL;
//echo 'Email: ' . $cadastro->getEmail() . PHP_EOL ;

//$cadastro->setIdade(35);
//$cadastro->setNumeroCpf('987.654.321-00');
//$cadastro->setDataNascimento(new DateTime('1988-01-01'));
//$cadastro->setEmail('jose.silva@example.com');