<?php
  include_once("class.aeroporto.php");
  include_once("class.cliente.php");

  class Viagem {

      private DateTime $_data_s;
      private DateTime $_data_c;
      private Aeronave $_aeronave;
      private string $_codigo;
      private Aeroporto $_aeroporto_chegada;
      private Aeroporto $_aeroporto_saida;
      private float $_duracao;
      private bool $_executado;
      private $_assentos = array(); //array_map(string, clientes())

        public function __construct (DateTime $data_s, DateTime $data_c, Aeronave $aeronave, 
                                    string $codigo, Aeroporto $aeroporto_chegada, 
                                    Aeroporto $aeroporto_saida, bool $execucao = false) { //Nao seria melho tirar esse = 0??
          $this->_data_s = $data_s;
          $this->_data_c = $data_c;
          $this->_aeronave = $aeronave;
          $this->_codigo = $codigo;
          $this->_aeroporto_chegada = $aeroporto_chegada;
          $this->_aeroporto_saida = $aeroporto_saida;
          $this->_executado = $execucao;
        }

        public function TrocarAeronave (Aeronave $aeronave) { //substituir por setAeronave?
          $this->_aeronave = $aeronave;
        }

        public function AddCliente (string $assento, Cliente $cliente) {
          array($assento => $cliente); //array de duas dimensões em que o assento é a chave e o cliente é o conteudo
        }

        public function getDataS () {
          return $this->_data_s;
        }

        public function getDataC () {
          return $this->_data_c;
        }

        public function getAeronave () {
          return $this->_aeronave;
        }

        public function getCodigo () {
          return $this->_codigo;
        }

        public function getAeroportoChegada () {
          return $this->_aeroporto_chegada->getSigla();
        }

        public function getAeroportoSaida () {
          return $this->_aeroporto_saida->getSigla();
        }

        public function getDuracao () {
          return $this->_duracao;
        }

        public function getExecutado () {
          return $this->_executado;
        }

        public function getAssentosLivres () {
          $assentos = array();
          foreach($this->_assentos as $as){
            if(count($as) == 0){
              array_push ($assentos, $as);
            }
          }
          return $assentos;
        }
  }
