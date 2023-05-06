<?php
  include_once("class.aeroporto.php");
  include_once("class.aeronave.php");
  include_once("class.passagem.php");
  include_once("persist.php");

  class Viagem extends persist{

      private DateTime $_data_s;
      private DateTime $_data_c;
      private Aeronave $_aeronave;
      private string $_codigo;
      private Aeroporto $_aeroporto_chegada;
      private Aeroporto $_aeroporto_saida;
      private DateInterval $_duracao;
      private bool $_executado;
      private $_assentos = array(); //array(numero do assento, nome do passageiro)
      static $local_filename = "viagens.txt";

      public function __construct (DateTime $data_s, 
                                  DateTime $data_c, 
                                  Aeronave $aeronave, 
                                  string $codigo, 
                                  Aeroporto $aeroporto_chegada, 
                                  Aeroporto $aeroporto_saida, 
                                  bool $execucao = false) { 
        $this->_data_s = $data_s;
        $this->_data_c = $data_c;
        $this->_duracao = $data_c->diff($data_s);
        $this->_aeronave = $aeronave;
        $this->_codigo = $codigo;
        $this->_aeroporto_chegada = $aeroporto_chegada;
        $this->_aeroporto_saida = $aeroporto_saida;
        $this->_executado = $execucao;
        $this->_assentos = $aeronave->getAssentos();
      }

      static public function getFilename() {
        return get_called_class()::$local_filename;
      }

      public function AddPassagem (string $assento, Passagem $passagem) {
        $nome_passageiro = $passagem->getPassageiro()->getCadastro()->getNome();
        $as_passagem = array($assento => $nome_passageiro);
        $this->_assentos = array_replace($this->_assentos, $as_passagem);
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
        $assentos = $this->_aeronave->getAssentos();
        $assentos_ocupados = array_diff($this->_assentos, $assentos);
        $assentos_livres = array_diff($this->_assentos, $assentos_ocupados);
        return $assentos_livres;
      }

      //E se trocar a aeronave mas os assentos delas já tiverem sido comprados?
      public function setAeronave(Aeronave $aeronave){
        $this->_aeronave = $aeronave;
        $this->_assentos = $aeronave->getAssentos(); 
      }

      public function setDates(DateTime $dataS, DateTime $dataC){
        $this->_data_s = $dataS;
        $this->_data_c = $dataC;
        $this->_duracao = $dataC->diff($dataS);
      }

      public function setAeroportoSaida(Aeroporto $aeroportoS){
        $this->_aeroporto_saida = $aeroportoS;
      }

      public function setAeroportoChegada(Aeroporto $aeroportoC) {
        $this->_aeroporto_chegada = $aeroportoC;
      }

      public function ViagemExecutada(){
        $this->_executado = 1;
      }
  }
