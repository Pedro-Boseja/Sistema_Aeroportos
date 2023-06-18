<?php
include_once "../Models/global.php";


class Cadastro extends persist{
    private string $_nome;
    private $_documento = array("RG" => "", "PASSAPORTE" => "", "CHT" => "");
    private string $_nacionalidade = "VAZIO";
    private string $_numero_cpf = "VAZIO";
    private DateTime $_data_nascimento;
    //private int $_idade; //pedro testes
    private string $_email = "VAZIO";
    private string $_endereco = "VAZIO";
    static $local_filename = "cadastros.txt";

    public function __construct(string $nome, string $documento){
        Usuario::ValidaLogado();
        $this -> _nome = $nome;
        $this -> SetDocumento($documento);
        $this->_data_nascimento = new DateTime('0002-02-02');
        $log = new Log_escrita(new DateTime(), "Cadastro", "null", serialize($this), "Cadastro criado");
        $log->save();
    }
  
    public function __toString(){
        return $this->_nome;
    }
  
    public function fillPassageiro(DateTime $data_nascimento, string $nacionalidade, string $email, string $numero_cpf){
        $this -> _data_nascimento = $data_nascimento;
        $this -> _nacionalidade = strtoupper($nacionalidade);
        $this -> _numero_cpf = $numero_cpf;
        $this -> _email = $email;
    }

    public function fillTripulante(DateTime $data_nascimento, string $nacionalidade, string $email, 
                                    string $numero_cpf, string $documento, string $endereco){
        $this -> _data_nascimento = $data_nascimento;
        $this -> _nacionalidade = strtoupper($nacionalidade);
        $this -> _numero_cpf = $numero_cpf;
        $this -> _email = $email;
        $this -> setDocumento($documento);
        $this -> _endereco = $endereco;
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
        //$_idade = 0;
        $idade = (New DateTime);
        $idade = $idade->diff($this -> getDataNascimento());
        //$this -> $_idade = $idade->y;
        return $idade->y;
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
        if($bool == 1){
            $this -> _documento["RG"] = $documento;
            return 0;}
        else $bool = valida_Passaporte($documento);
        if($bool == 1){
            $this -> _documento["PASSAPORTE"] = $documento;
            return 0;}
        else $this -> _documento["CHT"] = $documento;;
    }

    public function setNacionalidade(string $nacionalidade){
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