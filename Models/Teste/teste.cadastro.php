<?php

include_once "../global.php";

// Crie um objeto Cadastro simples (cliente)
$cadastro = new Cadastro(
    'João da Silva', // nome
    '12.244.876', //numero documento
);

// Testa os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'RG: ' . $cadastro->getDocumento("RG") . PHP_EOL;
echo 'PASSAPORTE: ' . $cadastro->getDocumento("PASSAPORTE") . PHP_EOL;
echo 'CHT: ' . $cadastro->getDocumento("CHT") . PHP_EOL;
echo "\n";

// Testa os métodos setters
$cadastro->setNome('José da Silva');
$cadastro->setDocumento('AB76543');

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
echo "\n";

// Completa um cliente para passageiro
$cadastro->fillPassageiro(
    new DateTime('1990-01-01'), // data de nascimento
    'brasileiro', // nacionalidade
    'joao.silva@example.com', // email
    '123.456.789-00', // CPF
);
   
// Testa os métodos getters
echo 'Nome: ' . $cadastro->getNome() . PHP_EOL;
echo 'Documento: ' . $cadastro->getDocumento("RG") . PHP_EOL;
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
echo 'Endereço: ' . $cadastro->getEndereco() . PHP_EOL;
echo "\n";

// Completa um cliente para tripulante
$cadastro->fillTripulante(
    new DateTime('1990-01-01'), // data de nascimento
    'brasileiro', // nacionalidade
    'joao.silva@example.com', // email
    '12345',
    'Rua dos Piratas, 99 - Centro, Caribe-CA, Haiti',
    '123.456.789-00' // CPF

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
echo "\n";