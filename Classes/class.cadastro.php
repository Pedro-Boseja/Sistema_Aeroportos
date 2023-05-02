<?php

class Cadastro extends persist{
    private string $_nome;
    private int $_idade;
    //private string $_numero_documento;
    private $_documento = array("RG" => "doc1", "PASSAPORTE" => "doc2", "CHT" => "doc3");
    private string $_numero_cpf;
    private DateTime $_data_nascimento;
    private string $_email;
    private string $_endereco;
    static $local_filename = "cadastros.txt";

    public function __construct(string $nome, string $numero_cpf, 
                                DateTime $data_nascimento, string $email) {
        $this -> _nome = $nome;
        $idade = (New DateTime);
        $idade = $idade->diff($data_nascimento);
        //$this -> _documento = strtoupper($documento);
        //$this -> _numero_documento = $numero_documento;
        $this -> _numero_cpf = $numero_cpf;
        $this -> _data_nascimento = $data_nascimento;
        $this -> _idade = $idade->y;
        $this -> _email = $email;
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }
    public function getNome (){
        return $this -> _nome;
    }

    public function getIdade(){
        return $this -> _idade;
    }

    //public function getNumeroDocumento(){
    //    return $this -> _numero_documento;
    //}

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

    //public function SetNumeroDocumento(string $numero_documento){
    //    $this -> _numero_documento = $numero_documento;
    //}

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
