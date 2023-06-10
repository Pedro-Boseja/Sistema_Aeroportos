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
      $log = new Log_escrita(new DateTime(), "Cliente", "null", serialize($this));
      $log->save();
    }
  
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }

    public function getCadastro() {
      return $this->_cadastro;
    }

    public function SolicitarViagem (Aeroporto $aero_c, Aeroporto $aero_s, DateTime $date, int $qnt) {
      Usuario::ValidaLogado();  
      $viagens = Facade::SolicitarViagem($aero_c, $aero_s, $date, $qnt);
      $el = count($viagens);

      try{
        count($viagens[0]);
        for($i = 0; $i < $el; $i++){
          echo "Viagem " . $i. "\n";
          $viagens[$i][0]->show();
          $viagens[$i][1]->show();
          echo "_________________\n";
        }

      }catch(TypeError $e){
        for($i = 0; $i < $el; $i++){
          echo "Viagem " . $i. "\n";
          $viagens[$i]->show();
          echo "_________________\n";
        }
      }
      
      return $viagens;

    }

    public function EscolherViagem ($viagens = array(), int $numero_viagem){
      $escolhidas = array();
      try{
        count($viagens[0]);
        array_push($escolhidas, $viagens[$numero_viagem][0]);
        array_push($escolhidas, $viagens[$numero_viagem][1]);
        return $escolhidas;

      }catch(TypeError $e){
        return $viagens[$numero_viagem];
      }
      
    }

    public function EscolherAssentos($viagem){
      try{
        $el = count($viagem);
        for($i = 0; $i<$el; $i++){
          $assentos = $viagem[$i]->getAssentosLivres();
          echo "Viagem ".$i."\n";
          print_r($assentos);
          echo "_________________\n";
        }

      }catch(TypeError $e){
        $assentos = $viagem[$i]->getAssentosLivres();
        print_r($assentos);
        echo "_________________\n";
      }
    }


    public function ComprarPassagem ($viagem, Passageiro $passageiro, $assentos = array(), int $qnt_franquias) {
      Usuario::ValidaLogado();
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