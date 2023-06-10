<?php

include_once "../global.php";


class Passageiro extends persist{

  protected Cadastro $_cadastro;
  protected $_viagens = array();
  protected ?Passagem $_passagem;
  static $local_filename = "passageiros.txt";

  public function __construct (Cadastro $cadastro,
                                DateTime $data_nascimento,
                                string $nacionalidade,
                                string $email,
                                string $numero_cpf = "VAZIO") {
                                  Usuario::ValidaLogado();
    $this->_cadastro = $cadastro;
    $this->_cadastro->fillPassageiro($data_nascimento, $nacionalidade, $numero_cpf, $email);
  }
  static public function getFilename() {
    return get_called_class()::$local_filename;
  }

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

  public function getViagens(){
    return $this->_viagens;
  }

  public function generateVip(){
    $vip = new Vip( $this );
    return $vip;
  }

  public function addPassagem(Passagem $passagem){
    $this->_passagem = $passagem;
  }

  public function CancelarPassagem () {
    if($this->_passagem == null){
      throw new Exception("Não há passagens para serem canceladas");
    }
    $this->_passagem->setStatus(EnumStatus::Passagem_cancelada);
    $this->_passagem->CancelarPassagem();
    $this->_passagem = null;
  }

  public function AlterarPassagem ($codigos = array(),$assentos=array(), $franquias) {
    if($this->_passagem->inicioDaViagem()<4){
      throw new Exception("O tempo para alterar a passagem terminou.\n");
    }else{
      $this->CancelarPassagem();
      Facade::ComprarPassagem($codigos, $this, $assentos, $franquias);
    }

  }
  
  public function Embarcar(){
    if($this->_passagem == null){
      throw new Exception("Não há passagens para embarcar\n");
    }

    $this->_passagem->setStatus(EnumStatus::Embarque_realizado);

  }
  
  public function IsVIP () {
    return false;
  }

}