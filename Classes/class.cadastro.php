<?php

class Cadastro {
    private string $_nome;
    private int $_idade;
    private string $_documento;
    private string $_numero_cpf;
    private DateTime $_data_nascimento;
    private string $_email;

    public function __construct(string $nome, string $documento, 
                                string $numero_cpf, DateTime $data_nascimento, string $email) {
        $this -> _nome = $nome;
        $idade = (New DateTime);
        $this -> _documento = strtoupper($documento);
        $this -> _numero_cpf = $numero_cpf;
        $this -> _data_nascimento = $data_nascimento;
        $this -> _idade = ($idade - $data_nascimento);
        $this -> _email = $email;
    }

    public function getNome (){
        return $this -> _nome;
    }

    public function getIdade(){
        return $this -> _idade;
    
    }
    public function getDocumento(){
        return $this -> _documento;
    }

    public function getNumeroCpf(){
        return $this -> _numero_cpf;
    }

    public function getDataNascimento(){
        return $this -> _data_nascimento;
    }

    public function getEmail(){
        return $this -> _email;
    }

    public function setNome(string $nome){
        $this -> _nome = $nome;
    }

    public function setIdade(int $idade){
        $this -> _idade = $idade;
    }

    public function SetDocumento(string $documento){
        $this -> _documento = $documento;
    }

    public function SetNumeroCpf(string $numero_cpf){
        $this -> _numero_cpf = $numero_cpf;
    }

    public function SetDataNascimento(DateTime $data_nascimento){
        $this -> _data_nascimento = $data_nascimento;
    }

    public function SetEmail(string $email){
        $this -> _email = $email;
    }


}    
