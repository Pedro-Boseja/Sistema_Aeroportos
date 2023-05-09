<?php
  include_once("class.aeronave.php");
  include_once("class.viagem.php");
  include_once("class.aeroporto.php");

  enum EnumDias{ //utilizado para determinar a frequencia de um voo
    case Sunday;
    case Monday;
    case Tuesday;
    case Wednesday;
    case Thursday;
    case Friday;
    case Saturday;
  }
    class Planejamento {
    
      private $_viagens_planejadas = array();
      private $_viagens_executadas = array();
      private $_frequencia = array();
      private string $_codigo_plan;
      private Aeronave $_aeronave;
      private Aeroporto $_ae_chegada;
      private Aeroporto $_ae_saida;
      private Datetime $_horario_c;
      private Datetime $_horario_s;
      private string $_companhia;


      public function __construct ($frequencia, string $codigo_plan, Aeronave $aeronave, 
                                  Aeroporto $chegada, Aeroporto $saida,
                                  DateTime $horarios, DateTime $horarioc, string $companhia = 'CA') {
        $this->_frequencia = $frequencia;
        $this->_codigo_plan = $codigo_plan;
        $this->_aeronave = $aeronave;
        $this->_ae_chegada = $chegada;
        $this->_ae_saida = $saida;
        $this->_horario_s = $horarios;
        $this->_horario_c = $horarioc;
        $this->_companhia = $companhia;
      }


      public function ExecutarViagem (string $codigo, Viagem $viagem_exe) {
        
        foreach ($this->_viagens_planejadas as $viagem){

          if ($viagem->getCodigo() == $codigo){

            $this->_viagens_executadas [ $codigo ] = array('planejado' => $viagem,
                                                           'executado' => $viagem_exe);

            
            unset($viagem);

            break;
          }
        }

      }
      
      public function ProgramaViagens(string $sigla){
        $data = new DateTime();

        for($i=0;$i<30;$i++){

          //verifica se o dia que está verificando está na frequencia.
          if(in_array(date("l", $data->getTimestamp()), $this->_frequencia)){
            
            //coleta o dia e a hora da partida.
            $dia_partida = $data->format('Y-m-d');
            $hora_partida = $this->_horario_s->format('h:i:s');
            
            //coleta o dia e a hora da chegada.
            $dia_chegada = $data->format('Y-m-d');
            $hora_chegada = $this->_horario_c->format('h:i:s');
            
            //transfomra os dados anteriores em uma variavel tipo DateTime.
            $data_partida = DateTime::createFromFormat('Y-m-d h:i:s', $dia_partida . " " . $hora_partida );
            $data_chegada = DateTime::createFromFormat('Y-m-d h:i:s', $dia_chegada . " " . $hora_chegada );
            
            //caracteres para a a fomração do código da viagem.
            $permint = "01234567890";
            
            //formação do código da viagem (número gerado aleatoriamente e iniciais da companhia aérea).
            $codigo = $this->_companhia . substr(str_shuffle($permint), 0, 4);
            
            //construtor da nova viagem.
            $viagem = new Viagem( $data_partida,
                        $data_chegada,
                        $this->_aeronave,
                        $codigo,
                        $this->_ae_chegada,
                        $this->_ae_saida,
                        false);
            
            array_push($this->_viagens_planejadas, $viagem);
          }
          
          //vai para o próximo dia.
          $data->setTimestamp($data->getTimestamp() + 86400);
      }
      }

      public function RemoverViagem(string $codigo){
        
        foreach ($this->_viagens_planejadas as $viagem){

          if ($viagem->getCodigo() == $codigo){

            unset($viagem);

            break;
          }
        }
      }

      public function EditarViagem(string $codigo, DateTime $date_partida, DateTime $date_chegada){
        
        foreach ($this->_viagens_planejadas as $viagem){

          if ($viagem->getCodigo() == $codigo){

            $viagem->setDates($date_partida, $date_chegada);

            break;
          }

        }

      }

      public function getFrequencia()
      {
          return $this -> _frequencia;  
      }
      public function getCodigo()
      {
          return $this -> _codigo_plan;  
      }
      public function setFrequencia($frequencia) 
      {
        $this -> _frequencia = $frequencia;
      }
      public function setCodigo(string $codigo_plan) 
      {
        $this -> _codigo_plan = $codigo_plan;
      }

      public function getAeroportoC(){
        return $this->_ae_chegada->getSigla();
      }
      public function getAeroportoS(){
        return $this->_ae_saida->getSigla();
      }

      public function getViagensPLanejadas(){
        return $this->_viagens_planejadas;
      }
      public function showViagens(){

        if(!$this->_viagens_planejadas) echo "opa \n";
        foreach ($this->_viagens_planejadas as $viagem){

          
          echo $viagem->getCodigo();
          echo " -> \n";
          echo $viagem->getAeroportoSaida()->getSigla();
          echo ": ";
          echo $viagem->getDataS()->format('m-d h:i');
          echo "\n";

          echo $viagem->getAeroportoChegada()->getSigla();
          echo ": ";
          echo $viagem->getDataC()->format('m-d h:i');
          echo "\n";
          echo "\n";
          
        }
      }

      //retorna uma viagem a partir de uma data.
      public function getViagemFromDate(DateTime $data){
        
        foreach($this->_viagens_planejadas as $viagem){

          if($viagem->getDataS()->format('Y m d') == $data->format('Y m d')){

            return $viagem;
            
          }
        }

        return null;
      }

      public function getHorarioS(){

        return $this->_horario_s;

      }

      public function getHorarioC(){

        return $this->_horario_c;
        
      }

      //verifica se o planejamento ocorre depois de um outro planejamento $plano.
      public function isAfter(Planejamento $plano){

        if($this->_horario_s->getTimestamp() > $plano->getHorarioS()->getTimestamp()){

          if($this->_horario_s->getTimestamp() > $plano->getHorarioC()->getTimestamp()){

            return true;

          }
        }

        return false;
      }

      
    }
