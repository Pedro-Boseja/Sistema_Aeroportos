<?php
 include_once "../global.php";


  class Viagem extends persist{

      private DateTime $_data_s;
      private DateTime $_data_c;
      protected string $_codigo;
      private Aeroporto $_aeroporto_chegada;
      private Aeroporto $_aeroporto_saida;
      private DateInterval $_duracao;
      private bool $_executado;
      private $_assentos = array(); //array(numero do assento, nome do passageiro)
      private int $_milhagem;
      private int $_multa = 100;
      private float $_tarifa = 1000.00;
      private float $_franquia;
      private $_tripulantes = array();
      private ?Veiculo $_veiculo;
      private ?Aeronave $_aeronave;
      private string $_companhia;
      static $local_filename = "viagens.txt";

      public function __construct (DateTime $data_s, 
                                  DateTime $data_c,  
                                  string $codigo, 
                                  Aeroporto $aeroporto_saida,
                                  Aeroporto $aeroporto_chegada, 
                                  string $comp,
                                  Aeronave $aeronave = null,
                                  float $franquia,
                                  int $milhagem = 100,
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
        $this->_franquia = $franquia;
      }

      static public function getFilename() {
        return get_called_class()::$local_filename;
        
      }

      public function getFranquia(){
        return $this->_franquia;
      }
      public function getTarifa(){
        return $this->_tarifa;
      }

      public function showAssentos(){
        $assentos = $this->_aeronave->getAssentos();
        print_r($assentos);
      }

      public function Show(){
          
          echo "Código: ".$this->getCodigo();
          echo " ==> \n";
          echo "Aeroporto de Saída: ".$this->getAeroportoSaida();
          echo ": ";
          echo $this->getDataS()->format('d-m H:i');
          echo "\n";

          echo "Aeroporto de Chegada: ".$this->getAeroportoChegada();
          echo ": ";
          echo $this->getDataC()->format('d-m H:i');
          echo "\n";
          echo "\n";
      }

      public function CancelarPassageiro(Passageiro $passageiro){
        foreach($this->_assentos as $p){
          if($passageiro->getCadastro()->getNome() == $p->getCadastro()->getNome()){
            $key = array_search($p, $this->_assentos);
            unset($this->_assentos[$key]);
          }
        }
        $mensagem = "Passageiro ".$passageiro->getCadastro()->getNome()." cancelado na viagem de ".
        $this->getAeroportoSaida() ." até ". $this->getAeroportoChegada();
        $log = new Log_escrita(new DateTime(), "Viagem", "null", serialize($this), $mensagem);
        $log->save();


      }

      public function addPassagem (string $assento, Passagem $passagem) {
        $passageiro = $passagem->getPassageiro();
        $as_passagem = array($assento => $passageiro);
        $this->_assentos = array_replace($this->_assentos, $as_passagem);
        
        $mensagem = "Passageiro ".$passageiro->getCadastro()->getNome()." cadastrado na viagem de ".
                    $this->getAeroportoSaida()." para ".$this->getAeroportoChegada()." no assento ".$assento;
        $log = new Log_escrita(new DateTime(), "Viagem", "null", serialize($this), $mensagem);
        $log->save();
      }

      public function getPassageiros(){
        $passageiros = array();
        foreach($this->_assentos as $a){
          array_push($passageiros, $a);
        }
        return $passageiros;
      }

      public function getDataS() {
        return $this->_data_s;
      }

      public function getDataC() {
        return $this->_data_c;
      }

      public function getAeronave() {
        return $this->_aeronave;
      }

      public function getCodigo() {
        return $this->_codigo;
      }

      public function getAeroportoChegada () {
        // return $this->_aeroporto_chegada; 
        return $this->_aeroporto_chegada->getSigla();
      }

      public function getAeroportoSaida () {
        // return $this->_aeroporto_saida;
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

        $log = new Log_leitura(new DateTime(), serialize($this), "Assentos", "informação de assentos da viagem lida");
        $log->save();

        return $assentos_livres;
      }

      
      //E se trocar a aeronave mas os assentos delas já tiverem sido comprados?
      // public function TrocarAeronave(Aeronave $aeronave){
      //   $this->_aeronave = $aeronave;
      //   $this->_assentos = $aeronave->getAssentos(); 
      // }

      public function AddTripulaçao($tripulacao){
        $mensagem ="Tripulação Adicionada a viagem";
        $log = new Log_escrita(new DateTime(), "companhia aerea", "Null", serialize($this), $mensagem);
        $log->save();

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
        $mensagem ="Aeronave ". $aeronave->getRegistro()." Confirmada na viagem";
        $log = new Log_escrita(new DateTime(), "companhia aerea", "Null", serialize($this), $mensagem);
        $log->save();
        $this->_aeronave = $aeronave;
        $this->save();
      }
      public function ViagemExecutada(){
        echo "Entrou na func";
        $this->_executado = true;
        //Verificação de Clientes VIP para contabilizar programa de milhagem.
        $companhia=CompanhiaAerea::getRecordsByField('_sigla', $this->_companhia);
        $milhagem = end($companhia)->getMilhagem();
        $passageiros = $milhagem->getPassageiros();

        echo "Antes entrar no loop";
        foreach($this->getPassageiros() as $p){
          echo "Passageiros da Viagem";
          foreach($passageiros as $m){
            echo "Passageiros Milhagem\n";
            echo $p->_cadastro->getNome() ." e ". $m->_cadastro->getNome();
            //Verificação se faz parte;
            if($p->_cadastro->getNome() == $m->_cadastro->getNome()){
              echo "Encontrado";
              //Adicionar Pontos
              $m->addPontos($this->_milhagem);

              //Upgrade de passageito;
              $milhagem->Upgrade($m);
            
            }
          }

        }
        echo "Fim do loop";
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
