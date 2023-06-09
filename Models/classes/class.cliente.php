<?php

include_once "../global.php";


class Cliente extends persist{

    private $_viagens_compradas = array();
    private $_passagens = array();
    static $local_filename = "clientes.txt";

    public function __construct() {
        
    }
  
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }

    public function getCadastro() {
    }
  
    public function EscolherAssento (Viagem $viagem){

      if(count($viagem->getAssentosLivres()) == 0) {
          echo "Esta viagem já está lotada!\n";
          return "x";
      } else {
          echo "Estes assentos estão disponíveis para a sua viagem: \n";
          foreach($viagem->getAssentosLivres() as $as){
            echo $as . "\n";
          }
          echo "Qual assento você deseja? \n";
          $resposta = fgets(STDIN);
          return $resposta;
      }
    }

    public function SolicitarViagem (string $aero_c, string $aero_s, DateTime $date, int $qnt) {
      Usuario::ValidaLogado();  
      $viagens = Facade::SolicitarViagem($aero_c, $aero_s, $date, $qnt);
        print_r($viagens);
    }

    public function ComprarPassagem ($codigos = array(), Passageiro $passageiro, int $qnt_franquias) {
      
    }

    public function CancelarViagem (Passagem $passagem){
      //coisa de passageiro
    }
  
}