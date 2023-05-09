<?php
    require_once('global.php');
    
    //Aeronave(string $fabricante,string $modelo, string $registro,int $capacidade_p,float $capacidade_c)
    $aeronave1 = new Aeronave("Boeing", "737", "ABC123", 200, 4000.0, 5, 10);
    $aeronave2 = new Aeronave("Airbus", "A320", "DEF456", 150, 3000.0, 5, 10);
    $aeronave3 = new Aeronave("Embraer", "E190", "GHI789", 100, 2000.0, 5, 10);
    $aeronave4 = new Aeronave("Boeing", "737-800", "PP-AAB", 180, 4000.0, 5, 10);
    $aeronave5 = new Aeronave("Airbus", "A320neo", "PP-BBA", 150, 3500.0, 5, 10);
    $aeronave6 = new Aeronave("Embraer", "E190-E2", "PP-CCA", 110, 2500.0, 5, 10);

    //Aeroporto(string $sigla, string $cidade, string $estado))
    $aeroporto1 = new Aeroporto("GRU", "São Paulo", "SP");
    $aeroporto2 = new Aeroporto("GIG", "Rio de Janeiro", "RJ");
    $aeroporto3 = new Aeroporto("BSB", "Brasília", "DF");
    
    //Cadastro(string $nome, string $documento, string $numero_documento, string $numero_cpf, DateTime $data_nascimento, string $email)
    $cadastro1 = new Cadastro("João Silva", "01234567890");
    $cadastro2 = new Cadastro("Maria Souza", "01234567891");
    $cadastro3 = new Cadastro("Pedro Santos", "01234567892");
    $cadastro4 = new Cadastro("Ana Costa", "01234567893");
    $cadastro5 = new Cadastro("Lucas Oliveira", "01234567894");
    $cadastro6 = new Cadastro("Carla Silva", "01234567895");
    $cadastro7 = new Cadastro("João Silva", "123456");
    $cadastro8 = new Cadastro("Maria Souza", "654321");
    $cadastro9 = new Cadastro("José Santos", "987654");
    
    //Cliente (Cadastro $cadastro)
    $cliente1 = new Cliente($cadastro4);
    $cliente2 = new Cliente($cadastro5);
    $cliente3 = new Cliente($cadastro6);
    
    //CompanhiaAerea(string $nome, int $codigo, string $cnpj, string $razao, string $sigla)
    $companhia1 = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AZL");
    $companhia2 = new CompanhiaAerea("Gol Linhas Aéreas", 456, "23.456.789/0001-02", "Gol S.A.", "GOL");
    $companhia3 = new CompanhiaAerea("Latam Airlines", 789, "34.567.890/0001-03", "Latam S.A.", "LTM");
    
    //Passageiro
    $passageiro1 = new Passageiro($cadastro1, new DateTime("1985-05-15"), "brasileiro", "01234567891" ,"maria.souza@email.com");
    $passageiro2 = new Passageiro($cadastro2, new DateTime("1985-05-15"), "brasileiro", "01234567891" ,"maria.souza@email.com");
    $passageiro3 = new Passageiro($cadastro3, new DateTime("1985-05-15"), "brasileiro", "01234567891" ,"maria.souza@email.com");
    
    
    //planejamentos ($frequencia, string $codigo_plan, Aeronave $aeronave, Aeroporto $chegada, Aeroporto $saida, DateTime $horarios, DateTime $horarioc, string $companhia = 'CA')
    $planejamento1 = new Planejamento(array(EnumDias::Sunday, EnumDias::Monday), "P001", $aeronave1, $aeroporto1, $aeroporto2, new DateTime('2023-05-01 08:00:00'), new DateTime('2023-05-01 10:00:00'), $companhia1);
    $planejamento2 = new Planejamento(array(EnumDias::Saturday, EnumDias::Friday), "P002", $aeronave2, $aeroporto2, $aeroporto3, new DateTime('2023-05-02 09:00:00'), new DateTime('2023-05-02 11:00:00'), $companhia2);
    $planejamento3 = new Planejamento(array(EnumDias::Thursday, EnumDias::Wednesday), "P003", $aeronave3, $aeroporto3, $aeroporto1, new DateTime('2023-05-03 10:00:00'), new DateTime('2023-05-03 12:00:00'), $companhia3);
    
    //Viagem(DateTime $data_s, DateTime $data_c, Aeronave $aeronave, string $codigo, Aeroporto $aeroporto_chegada, Aeroporto $aeroporto_saida, bool $execucao = false)
    $viagem1 = new Viagem(new DateTime('2023-05-01 08:00:00'), new DateTime('2023-05-01 10:00:00'), $aeronave1, "V001", $aeroporto1, $aeroporto2);
    $viagem2 = new Viagem(new DateTime('2023-05-02 09:00:00'), new DateTime('2023-05-02 11:00:00'), $aeronave2, "V002", $aeroporto2, $aeroporto3);
    $viagem3 = new Viagem(new DateTime('2023-05-03 10:00:00'), new DateTime('2023-05-03 12:00:00'), $aeronave3, "V003", $aeroporto3, $aeroporto2);

//Passagem(float $tarifa, Viagem $viagem, string $assento, Passageiro $passageiro)
    $passagem1 = new Passagem(1000.0, $viagem1, "A1", $passageiro1);
    $passagem2 = new Passagem(1500.0, $viagem2, "B2", $passageiro2);
    $passagem3 = new Passagem(2000.0, $viagem3, "C3", $passageiro3);


  $passageiros = Passageiro::getRecords();
  print_r($passageiros[0]->getCadastro()->getNome());
