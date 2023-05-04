<?php

include_once ('class.cadastro.php');
include_once ('class.viagem.php');

class Passageiro extends persist{

  protected Cadastro $_cadastro;
  protected $_franquias = array();
  protected $_viagens = array();
  static $local_filename = "passageiros.txt";

  public function __construct (Cadastro $cadastro, DateTime $data_nascimento, string $nacionalidade, string $numero_cpf = "VAZIO", string $email) {
    $this->_cadastro = $cadastro;
    $cadastro->fillPassageiro($data_nascimento, $nacionalidade, $numero_cpf, $email);
  }
  static public function getFilename() {
    return get_called_class()::$local_filename;
  }

  public function addFranquia(string $franquia){}

  public function delFranquia(string $franquia){}

  public function addViagem(Viagem $viagem){
    array_push($_viagens, $viagem);
  }

  public function delViagem(Viagem $viagem){
    unset($_viagens, $viagem);
  }
  public function getViagem(string $codigo){

    foreach($this->_viagens as $viagem){

      if($viagem->getCodigo() == $codigo){
       
        return $viagem;

      }
    }

    return null;
  }

  public function getCadastro(){

    return $this->_cadastro;

  }

  


}