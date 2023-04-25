<?php

include_once ('class.cadastro.php');
include_once ('class.viagem.php');

class Passageiro extends persist{

  protected Cadastro $_cadastro;
  protected $_franquias = array();
  protected $_viagens = array();
  static $local_filename = "passageiros.txt";

  public function __construct () {
    //$this->_cadastro = $cadastro;
  }
  static public function getFilename() {
    return get_called_class()::$local_filename;
  }
}