<?php

include_once "../global.php";


  // enum EnumDias{ //utilizado para determinar a frequencia de um voo
  //   case Sunday;
  //   case Monday;
  //   case Tuesday;
  //   case Wednesday;
  //   case Thursday;
  //   case Friday;
  //   case Saturday;
  // }
    class Planejamento {
    
      private $_viagens_planejadas = array();
      private $_viagens_executadas = array();
      private $_frequencia = array();
      private string $_codigo_plan;
      private Aeroporto $_ae_chegada;
      private Aeroporto $_ae_saida;
      private Datetime $_horario_c;
      private Datetime $_horario_s;
      private CompanhiaAerea $_companhia;
      private int $_milhagem;

      public function __construct ($frequencia, string $codigo_plan, 
                                  Aeroporto $saida, Aeroporto $chegada,
                                  DateTime $horarios, DateTime $horarioc,
                                  int $milhagem, CompanhiaAerea $companhia) {
                                    Usuario::ValidaLogado();
        $this->_frequencia = $frequencia;
        $this->_codigo_plan = $codigo_plan;
        $this->_ae_chegada = $chegada;
        $this->_ae_saida = $saida;
        $this->_horario_s = $horarios;
        $this->_horario_c = $horarioc;
        $this->_milhagem = $milhagem;
        $this->_companhia = $companhia;
        $this->_companhia->addPlanejamento($this);
      }

      //retorna a aeronave, veiculo e tripulação disponível da companhia aérea para criar viagens
      public function getDisponiveis(){

      }

     /* public function ExecutarViagem (Viagem $viagem_exe) {

        $codigo = $viagem_exe->getCodigo();

        foreach ($this->_viagens_planejadas as $viagem){

          if ($viagem->getCodigo() == $codigo){

            $viagem_exe->ViagemExecutada();
            $this->_viagens_executadas [ $codigo ] = $viagem_exe;
            $this->setPontos($viagem_exe->getPassageiros());
            //unset($viagem);
            return;

          }

        }

        throw new Exception("Essa viagem não foi encontrada no planejamento.");

      }
      private function setPontos($passageiros){
        $milhagem = $this->_companhia->getMilhagem();
        $mpassageiros = $milhagem->getPassageiros();
        echo "Passageiros: ".count($passageiros )."  Milhagem: ".count($mpassageiros);
        foreach($passageiros as $p){
          echo "Passageiros da Viagem";
          foreach($mpassageiros as $m){
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
      }*/
      public function ProgramaViagens(){
        $obj_antes = serialize($this);
        $data = new DateTime();
        $aeronave = $this->_companhia->getAeronavesDisponiveis();
        $log = new Log_leitura(new DateTime(), "Companhia Aerea", "Aeronave disponível", "Verificação de aeronaves disponíveis da companhia ". $this->_companhia->getRazao());
        $log->save();

        for($i=0;$i<30;$i++){

          //verifica se o dia que está verificando está na frequencia.
          if(in_array(date("l", $data->getTimestamp()), $this->_frequencia)){
            
            //coleta o dia e a hora da partida.
            $dia_partida = $data->format('Y-m-d');
            $hora_partida = $this->_horario_s->format('H:i:s');
            
            //coleta o dia e a hora da chegada.
            $dia_chegada = $data->format('Y-m-d');
            $hora_chegada = $this->_horario_c->format('H:i:s');
            
            
            //transfomra os dados anteriores em uma variavel tipo DateTime.
            $data_partida = DateTime::createFromFormat('Y-m-d H:i:s', $dia_partida . " " . $hora_partida );
            $data_chegada = DateTime::createFromFormat('Y-m-d H:i:s', $dia_chegada . " " . $hora_chegada );
            
            if($data_partida->getTimestamp() > $data_chegada->getTimestamp()){

              $mid = $data_partida;

              $data_partida = $data_chegada;

              $data_chegada = $mid;
              
              $data_chegada->setTimestamp($data->getTimestamp() + 86400);

            }

            //caracteres para a a fomração do código da viagem.
            $permint = "01234567890";
            
            //formação do código da viagem (número gerado aleatoriamente e iniciais da companhia aérea).
            $letras = $this->_companhia->getSigla();
            $codigo = $letras . substr(str_shuffle($permint), 0, 4);
            
            //construtor da nova viagem.
            
            $viagem = new Viagem($data_partida,
                        $data_chegada,
                        $codigo,
                        $this->_ae_saida,
                        $this->_ae_chegada,
                        $this->_companhia->getSigla(),
                        $aeronave,
                        $this->_companhia->getFranquia(),
                        $this->_milhagem
                        );
            //$viagem->setCodigoPlan($this->_codigo_plan);
            $viagem->save(); //comentar
            array_push($this->_viagens_planejadas, $viagem);
          }
          
          //vai para o próximo dia.
          $data->setTimestamp($data->getTimestamp() + 86400);
        }

        $mensagem = "Viagens Para os Próximos 30 dias entre ".$this->getAeroportoS()." e ".$this->getAeroportoC(). " Programadas";

        $log = new Log_escrita(new DateTime(), "PLanejamento", $obj_antes, serialize($this), $mensagem);
        $log->save();
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

      public function getFrequencia(){
          return $this -> _frequencia;  
      }

      public function getCodigo(){
          return $this -> _codigo_plan;  
      }

      public function getMilhagem()
      {
        return $this -> _milhagem;
      }

      public function getCompanhia()
      {
        return $this -> _companhia->getNome();
      }


      public function setFrequencia($frequencia){
        $this -> _frequencia = $frequencia;
      }
      
      public function setCompanhia(CompanhiaAerea $companhia){
        $this->_companhia = $companhia;
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

        // if(!$this->_viagens_planejadas) echo "opa \n";
        foreach ($this->_viagens_planejadas as $viagem){

          
          echo $viagem->getCodigo();
          echo " -> \n";
          echo $viagem->getAeroportoSaida();
          echo ": ";
          echo $viagem->getDataS()->format('m-d H:i');
          echo "\n";

          echo $viagem->getAeroportoChegada();
          echo ": ";
          echo $viagem->getDataC()->format('m-d H:i');
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

      public function assignAeronave(Aeronave $aeronave, Viagem $viagem){

        if( $aeronave->isAvaliable($viagem) ){

          $aeronave->addViagem($viagem);
          $viagem->setAeronave($aeronave);

        }

      }

      public function assignVeiculo(Veiculo $veiculo, Viagem $viagem){

        if( $veiculo->isAvaliable($viagem) ){

          $veiculo->addViagem($viagem);

        }

      }

      // public function assignTripulante(Tripulante $tripulante, Viagem $viagem){

      //   if( $tripulante->isAvaliable($viagem) ){

      //     $tripulante->addViagem($viagem);

      //   }

      // }

      public function createViagem(string $codigo, DateTime $dia_de_saida){
        $obj_antes = serialize($this);
        $letras = $this->_companhia->getSigla();
        $comp = substr($codigo, 0, 2);
        if($letras != $comp){
          throw new Exception("Codigo inválido\n");
        }  
        
        $hora_partida = $this->_horario_s->format('H:i:s'); 
        $hora_chegada = $this->_horario_c->format('H:i:s');

        $dia_de_chegada = $dia_de_saida;

        //se o horario de chegada for no outro dia, adicione um dia no dia de chegada.
        if($this->_horario_s->getTimestamp() > $this->_horario_c->getTimestamp()){

          $dia_de_chegada->setTimestamp( $dia_de_chegada->getTimestamp() + 86400);

        }
        $dias = $dia_de_saida->format('Y-m-d');
        $diac = $dia_de_chegada->format('Y-m-d');
        $data_partida = DateTime::createFromFormat('Y-m-d H:i:s', $dias . " " . $hora_partida );
        $data_chegada = DateTime::createFromFormat('Y-m-d H:i:s', $diac . " " . $hora_chegada );
        
        $aeronave = $this->_companhia->getAeronavesDisponiveis();
        $viagem = new Viagem($data_partida,
                        $data_chegada,
                        $codigo,
                        $this->_ae_chegada,
                        $this->_ae_saida,
                        $this->_companhia->getSigla(),
                        $aeronave,
                        $this->_companhia->getFranquia(),
                        $this->_milhagem
                        );
        //$viagem->setCodigoPlan($this->_codigo_plan);
        $viagem->save();
        array_push($this->_viagens_planejadas, $viagem);
        $mensagem = "Viagem ".$codigo."Entre ".$this->getAeroportoS()." e ".$this->getAeroportoC().", para o dia ".$dia_de_saida->format("Y-m-d H:i:s")." criada";
        $log = new Log_escrita(new DateTime(), "Planejamento", $obj_antes, serialize($this), $mensagem);
        $log->save();
      }
    }
