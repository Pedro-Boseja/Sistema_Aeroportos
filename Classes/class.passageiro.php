<?php

include_once ('class.cadastro.php');
include_once ('class.viagem.php');

class Passageiro {

  protected Cadastro $_cadastro;
  protected $_franquias = array();
  protected $_viagens = array();

  public function __construct (Cadastro $cadastro) {
    $this->_cadastro = $cadastro;
  }

  public function getCadastro () {
    return $this->_cadastro;
  }

}