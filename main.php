<?php
    require_once('global.php');
    // //Aeronave(string $fabricante,string $modelo, string $registro,int $capacidade_p,float $capacidade_c)
    // $aeronave1 = new Aeronave("Boeing", "737", "ABC123", 200, 4000.0);
    // $aeronave2 = new Aeronave("Airbus", "A320", "DEF456", 150, 3000.0);
    // $aeronave3 = new Aeronave("Embraer", "E190", "GHI789", 100, 2000.0);
    // $aeronave4 = new Aeronave("Boeing", "737-800", "PP-AAB", 180, 4000.0);
    // $aeronave5 = new Aeronave("Airbus", "A320neo", "PP-BBA", 150, 3500.0);
    // $aeronave6 = new Aeronave("Embraer", "E190-E2", "PP-CCA", 110, 2500.0);
    // //Aeroporto(string $sigla, string $cidade, string $estado))
    // $aeroporto1 = new Aeroporto("GRU", "São Paulo", "SP");
    // $aeroporto2 = new Aeroporto("GIG", "Rio de Janeiro", "RJ");
    // $aeroporto3 = new Aeroporto("BSB", "Brasília", "DF");
    // //Cadastro(string $nome, string $documento, string $numero_documento, string $numero_cpf, DateTime $data_nascimento, string $email)
    $cadastro1 = new Cadastro("João Silva", "01234567890");
    // $cadastro2 = new Cadastro("Maria Souza", "01234567891", "0002", "11122233345", new DateTime("1985-05-15"), "maria.souza@email.com");
    // $cadastro3 = new Cadastro("Pedro Santos", "01234567892", "0003", "11122233346", new DateTime("1992-08-27"), "pedro.santos@email.com");
    // $cadastro4 = new Cadastro("Ana Costa", "01234567893", "0004", "11122233347", new DateTime("1983-12-10"), "ana.costa@email.com");
    // $cadastro5 = new Cadastro("Lucas Oliveira", "01234567894", "0005", "11122233348", new DateTime("1997-03-20"), "lucas.oliveira@email.com");
    // $cadastro6 = new Cadastro("Carla Silva", "01234567895", "0006", "11122233349", new DateTime("1989-06-03"), "carla.silva@email.com");
    // $cadastro7 = new Cadastro("João Silva", "RG", "123456", "789456123-45", new DateTime("1990-01-01"), "joao.silva@email.com");
    // $cadastro8 = new Cadastro("Maria Souza", "CNH", "654321", "123456789-12", new DateTime("1985-05-05"), "maria.souza@email.com");
    // $cadastro9 = new Cadastro("José Santos", "RG", "987654", "456789123-78", new DateTime("1995-12-31"), "jose.santos@email.com");
    // //Cliente (Cadastro $cadastro)
    // $cliente1 = new Cliente($cadastro4);
    // $cliente2 = new Cliente($cadastro5);
    // $cliente3 = new Cliente($cadastro6);
    // //CompanhiaAerea(string $nome, int $codigo, string $cnpj, string $razao, string $sigla)
    // $companhia1 = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AZL");
    // $companhia2 = new CompanhiaAerea("Gol Linhas Aéreas", 456, "23.456.789/0001-02", "Gol S.A.", "GOL");
    // $companhia3 = new CompanhiaAerea("Latam Airlines", 789, "34.567.890/0001-03", "Latam S.A.", "LTM");
    // //Passageiro
    // $passageiro1 = new Passageiro($cadastro1);
    // $passageiro2 = new Passageiro($cadastro2);
    // $passageiro3 = new Passageiro($cadastro3);
    // //Passagem(float $tarifa, Viagem $viagem, string $assento, Passageiro $passageiro)
    // $passagem1 = new Passagem(1000.0, $viagem1, "A1", $passageiro1);
    // $passagem2 = new Passagem(1500.0, $viagem2, "B2", $passageiro2);
    // $passagem3 = new Passagem(2000.0, $viagem3, "C3", $passageiro3);
    // //planejamentos ($frequencia, string $codigo_plan, Aeronave $aeronave, Aeroporto $chegada, Aeroporto $saida, DateTime $horarios, DateTime $horarioc, string $companhia = 'CA')
    // $planejamento1 = new Planejamento(array(EnumDias::Sunday, EnumDias::Monday), "P001", $aeronave1, $aeroporto1, $aeroporto2, new DateTime('2023-05-01 08:00:00'), new DateTime('2023-05-01 10:00:00'), $companhia1);
    // $planejamento2 = new Planejamento(array(EnumDias::Saturday, EnumDias::Friday), "P002", $aeronave2, $aeroporto2, $aeroporto3, new DateTime('2023-05-02 09:00:00'), new DateTime('2023-05-02 11:00:00'), $companhia2);
    // $planejamento3 = new Planejamento(array(EnumDias::Thursday, EnumDias::Wednesday), "P003", $aeronave3, $aeroporto3, $aeroporto4, new DateTime('2023-05-03 10:00:00'), new DateTime('2023-05-03 12:00:00'), $companhia3);
    // //Viagem(DateTime $data_s, DateTime $data_c, Aeronave $aeronave, string $codigo, Aeroporto $aeroporto_chegada, Aeroporto $aeroporto_saida, bool $execucao = false)
    // $viagem1 = new Viagem(new DateTime('2023-05-01 08:00:00'), new DateTime('2023-05-01 10:00:00'), $aeronave1, "V001", $aeroporto1, $aeroporto2);
    // $viagem2 = new Viagem(new DateTime('2023-05-02 09:00:00'), new DateTime('2023-05-02 11:00:00'), $aeronave2, "V002", $aeroporto2, $aeroporto3);
    // $viagem3 = new Viagem(new DateTime('2023-05-03 10:00:00'), new DateTime('2023-05-03 12:00:00'), $aeronave3, "V003", $aeroporto3, $aeroporto4);
