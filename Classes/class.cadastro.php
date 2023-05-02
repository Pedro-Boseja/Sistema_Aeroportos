<?php
include_once("../verificacoes.php");
class Cadastro extends persist{
    private string $_nome;
    private $_documento = array("RG" => "doc1", "PASSAPORTE" => "doc2", "CHT" => "doc3");
    private string $_nacionalidade;
    private string $_numero_cpf;
    private DateTime $_data_nascimento;
    //private int $_idade; pedro testes
    private string $_email;
    private string $_endereco;
    static $local_filename = "cadastros.txt";

    public function __construct(string $nome, string $documento){
        $this -> _nome = $nome;
        $this -> SetDocumento($documento);
    }

    public function fillPassageiro(DateTime $data_nascimento, string $nacionalidade, string $numero_cpf, string $email){
        $this -> _data_nascimento = $data_nascimento;
        $this -> _nacionalidade = strtoupper($nacionalidade);
        $this -> _numero_cpf = $numero_cpf;
        $this -> _email = $email;
    }

    public function fillTripulante(string $documento, string $endereco){
        $this -> _endereco = $endereco;
        $this -> _documento["CHT"] = $documento;
        
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

//gets

    public function getNome(){
        return $this -> _nome;
    }

    public function getDocumento(string $documento){
        return $this -> _documento[$documento];
    }

    public function getNacionalidade(){
        return $this -> _nacionalidade;    
    }
    
    public function getNumeroCpf(){
        return $this -> _numero_cpf;
    }

    public function getDataNascimento(){
        return $this -> _data_nascimento;
    }

    public function getIdade(){
        $_idade = 0;
        $idade = (New DateTime);
        $idade = $idade->diff($this -> getDataNascimento());
        $this -> $_idade = $idade->y;
        return $this -> $_idade;
    }

    public function getEmail(){
        return $this -> _email;
    }

    public function getEndereco(){
        return $this -> _endereco;
    }

//sets

    public function setNome(string $nome){
        $this -> _nome = $nome;
    }

    public function setDocumento(string $documento){
        $bool = 0; 
        $bool = valida_Rg($documento);
        if($bool == 1)
            $this -> _documento["RG"] = $documento;
        else $bool = valida_Passaporte($documento);
        if($bool == 1)
            $this -> _documento["PASSAPORTE"] = $documento;
        else $this -> _documento["CHT"] = $documento;;
    }

    public function setNacionalidade(int $nacionalidade){
        $this -> _nacionalidade = $nacionalidade;
    }

    public function setNumeroCpf(string $numero_cpf){
        $this -> _numero_cpf = $numero_cpf;
    }

    public function setDataNascimento(DateTime $data_nascimento){
        $this -> _data_nascimento = $data_nascimento;
    }

    // public function setIdade(int $idade){
    //     $this -> _idade = $idade;
    // }

    public function setEmail(string $email){
        $this -> _email = $email;
    }

    public function setEndereco(string $endereco){
        $this -> _endereco = $endereco;
    }

}    
