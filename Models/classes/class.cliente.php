<?php

include_once "../global.php";


class Cliente extends persist{
    private $_cadastro;

    private $_viagens_compradas = array();
    private $_passagens = array();
    static $local_filename = "clientes.txt";

    public function __construct(string $nome, string $documento) {
      Usuario::ValidaLogado();
      $this->_cadastro = new Cadastro($nome, $documento);
      $log = new Log_escrita(new DateTime(), "Cliente", "null", serialize($this), "Cliente ". $nome ." cadastrado");
      $log->save();
    }
  
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }

    public function getCadastro() {
      return $this->_cadastro;
    }

    public function SolicitarViagem (Aeroporto $aero_s, Aeroporto $aero_c, DateTime $date, int $qnt) {
      Usuario::ValidaLogado();
      $mensagem = "Viagens Solicitadas entre ".$aero_s->getSigla()." e ".$aero_c->getSigla();
      $log = new Log_leitura(new DateTime(), "Cliente", "viagens", $mensagem);
      $log->save();

      $viagens = Facade::SolicitarViagem($aero_s, $aero_c, $date, $qnt);
      $el = count($viagens);

      echo"\nAs viagens Possíveis são: \n";
      try{
        count($viagens[0]);
        for($i = 0; $i < $el; $i++){
          echo "_________________\n";
          echo "Viagem " . $i. "\n";
          $viagens[$i][0]->show();
          $viagens[$i][1]->show();
          echo "_________________\n";
        }

      }catch(TypeError $e){
        for($i = 0; $i < $el; $i++){
          echo "_________________\n";
          echo "Viagem " . $i. "\n";
          $viagens[$i]->show();
          echo "_________________\n";
        }
      }
      
      return $viagens;

    }

    public function EscolherViagem ($viagens, int $numero_viagem){
      Usuario::ValidaLogado();

      $escolhidas = array();
      try{
        count($viagens[0]);
        array_push($escolhidas, $viagens[$numero_viagem][0]);
        array_push($escolhidas, $viagens[$numero_viagem][1]);

        $v1 = $viagens[$numero_viagem][0];
        $v2 = $viagens[$numero_viagem][1];

        $mensagem = "Viagens ".$v1->getCodigo(). " e ".$v2->getCodigo() . " Escolhidas";
        $log = new Log_leitura(new DateTime(), "Cliente", "viagens", $mensagem);
        $log->save();
        return $escolhidas;

      }catch(TypeError $e){
        $v1 = $viagens[$numero_viagem];
        $mensagem = "Viagem ".$v1->getCodigo()." Escolhidas";
        $log = new Log_leitura(new DateTime(), "Cliente", "viagens", $mensagem);
        $log->save();
        return $viagens[$numero_viagem];
      }
      
    }

    public function EscolherAssentos($viagem){
      Usuario::ValidaLogado();

      $log = new Log_leitura(new DateTime(), "Cliente", "viagens", "Assentos da viagem Escolhidos");
      $log->save();
      try{
        $el = count($viagem);
        for($i = 0; $i<$el; $i++){
          $assentos = $viagem[$i]->getAssentosLivres();
          if($i == 0){
            echo "Assentos Primeira Viagem: \n";
          }else{
            echo "Assentos Segunda Viagem: \n";
          }
          print_r($assentos);
          echo "_________________\n";
        }

      }catch(TypeError $e){
        $assentos = $viagem->getAssentosLivres();
        print_r($assentos);
        echo "_________________\n";
      }
    }


    public function ComprarPassagem ($viagem, Passageiro $passageiro, $assentos, int $qnt_franquias) {
  
      Usuario::ValidaLogado();

      $log = new Log_leitura(new DateTime(), "Cliente", "viagens", "Viagens Escolhidas Foram Compradas");
      $log->save();
      $codigos = array();
      
      try{
        $el = count($viagem);
        for($i = 0; $i<$el; $i++){
          array_push($codigos, $viagem[$i]->getCodigo());
        }
        

      }catch(TypeError $e){
        array_push($codigos, $viagem->getCodigo());
      }

      Facade::ComprarPassagem($codigos, $passageiro, $assentos, $qnt_franquias);

    }

    // public function CancelarViagem (Passagem $passagem){
    //   //coisa de passageiro
    // }
  
}