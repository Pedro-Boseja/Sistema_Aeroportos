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
    $log = new Log_escrita(new DateTime(), "Companhia Aerea", "null", serialize($this), "Passageiro ".$cadastro->getNome(). " Cadastrado");
    $log->save();
  }
  static public function getFilename() {
    return get_called_class()::$local_filename;
  }
  
  public function __toString(){
        return $this->_cadastro->__toString();
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

  public function getPassagem(){
    return $this->_passagem;
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

    $mensagem = "Passagem adicionada ao Passageiro ".$this->_cadastro->getNome();

    $log = new Log_leitura(new DateTime(), "Passageiro", "viagens", $mensagem);
    $log->save();
  }

  public function CancelarPassagem () {
    if($this->_passagem == null){
      throw new Exception("Não há passagens para serem canceladas");
    }
    $this->_passagem->setStatus(EnumStatus::Passagem_cancelada);
    $this->_passagem->CancelarPassagem();
    $this->_passagem = null;
  }

  public function AlterarPassagem ($codigos ,$assentos, $franquias) {//codigo = array e assentos=array
    if($this->_passagem->inicioDaViagem()<4){
      throw new Exception("O tempo para alterar a passagem terminou.\n");
    }else{
      $this->CancelarPassagem();
      Facade::ComprarPassagem($codigos, $this, $assentos, $franquias);
    }

  }

  public function Embarcar($i){
    if($this->_passagem == null){
      throw new Exception("Não há viagens para embarcar");
    }

    $this->_passagem->setStatus(EnumStatus::Embarque_realizado);
    $v = $this->_passagem->getViagens();
    $mensagem = "Passageiro ".$this->_cadastro->getNome()." embarcou no voo ".$v[$i]->getCodigo();
    $log = new Log_leitura(new DateTime(), "Passageiro", "viagens", $mensagem);
    $log->save();

  }

  public function IsVIP () {
    return false;
  }
  public function getNome(){
    return $this->_cadastro->getNome();
}
}  
