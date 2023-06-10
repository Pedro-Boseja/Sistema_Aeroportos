<?php
 include_once "../global.php";


  class Viagem extends persist{

      private DateTime $_data_s;
      private DateTime $_data_c;
      private string $_codigo;
      private Aeroporto $_aeroporto_chegada;
      private Aeroporto $_aeroporto_saida;
      private DateInterval $_duracao;
      private bool $_executado;
      private $_assentos = array(); //array(numero do assento, nome do passageiro)
      private int $_milhagem;
      private int $_multa = 100;
      private $_tripulantes = array();
      private ?Veiculo $_veiculo;
      private ?Aeronave $_aeronave;
      private ?CompanhiaAerea $_companhia;
      static $local_filename = "viagens.txt";

      public function __construct (DateTime $data_s, 
                                  DateTime $data_c,  
                                  string $codigo, 
                                  Aeroporto $aeroporto_chegada, 
                                  Aeroporto $aeroporto_saida,
                                  CompanhiaAerea $comp = null,
                                  Aeronave $aeronave = null,
                                  int $milhagem = 0,
                                  bool $execucao = false
                                  ) { 

        Usuario::ValidaLogado();
        $this->_data_s = $data_s;
        $this->_data_c = $data_c;
        $this->_duracao = $data_c->diff($data_s);
        $this->_codigo = $codigo;
        $this->_aeroporto_chegada = $aeroporto_chegada;
        $this->_aeroporto_saida = $aeroporto_saida;
        $this->_executado = $execucao;
        $this->_milhagem = $milhagem;
        $this->_companhia = $comp;
        $this->_aeronave = $aeronave;
      }

      static public function getFilename() {
        return get_called_class()::$local_filename;
        
      }

      public function showAssentos(){
        $assentos = $this->_aeronave->getAssentos();
        print_r($assentos);
      }

      public function CancelarPassageiro(Passageiro $passageiro){
        foreach($this->_assentos as $p){
          if($passageiro->getCadastro()->getNome() == $p->getCadastro()->getNome()){
            $key = array_search($p, $this->_assentos);
            unset($this->_assentos[$key]);
          }
        }
      }

      public function addPassagem (string $assento, Passagem $passagem) {
        $passageiro = $passagem->getPassageiro();
        $as_passagem = array($assento => $passageiro);
        $this->_assentos = array_replace($this->_assentos, $as_passagem);
      }

      public function getPassageiros(){
        $passageiros = array();
        foreach($this->_assentos as $a){
          array_push($passageiros, $a);
        }
        return $passageiros;
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

      public function getMilhagem () {
        return $this->_milhagem;
      }

      public function getTripulantes () {
        return $this->_tripulantes;
      }

      public function getVeiculo () {
        return $this->_veiculo;
      }

      public function getCompanhia () {
          return $this->_companhia;
      }

      public function getAssentosLivres () {
        $assentos = $this->_aeronave->getAssentos();

        if(count($this->_assentos) == 0){
          return $assentos;
        }

        $assentos_ocupados = array_diff($this->_assentos, $assentos);
        $assentos_livres = array_diff($this->_assentos, $assentos_ocupados);
        return $assentos_livres;
      }


      //E se trocar a aeronave mas os assentos delas já tiverem sido comprados?
      // public function TrocarAeronave(Aeronave $aeronave){
      //   $this->_aeronave = $aeronave;
      //   $this->_assentos = $aeronave->getAssentos(); 
      // }

      public function AddTripulaçao($tripulacao){

        foreach($tripulacao as $tripulante){

          if(!$tripulante->isAvaiable($this)){
            return false;
          }

        }

        foreach($tripulacao as $tripulante){

          array_push($this->_tripulantes, $tripulante);

        }

        return true;
      }

      public function TrocarVeículo(Veiculo $veiculo){
        $this->_veiculo = $veiculo;
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

      public function setAeronave(Aeronave $aeronave){
        $this->_aeronave = $aeronave;
      }
      public function ViagemExecutada(){
        $this->_executado = 1;
      }
      public function getMulta(){
        return $this->_multa;
      }

      public function setMulta($multa){
        $this->_multa = $multa;
      }
      public function IsIn(Viagem $viagem){

        $ok = false;
        if( $this->_data_s->getTimestamp() > $viagem->getDataS()->getTimestamp() ){
          if($this->_data_s->getTimestamp() < $viagem->getDataC()->getTimestamp() ){
            $ok = true;
          }
        }
        if( $this->_data_c->getTimestamp() > $viagem->getDataS()->getTimestamp() ){
          if($this->_data_c->getTimestamp() < $viagem->getDataC()->getTimestamp() ){
            $ok = true;
          }
        }
        return $ok;
      }
  }
