<?php

include_once "../Models/global.php";

    class Vip extends Passageiro{

        private int $_n_registro;

        private float $_desconto;

        private $_pontos_milhagem = array();

        static $local_filename = "passageirosVip.txt";

        public function __construct(Passageiro $passageiro){
            $this->_cadastro = $passageiro->getCadastro();
            $this->_viagens = $passageiro->getViagens();
        }

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }

        public function getDesconto () {
            return $this->_desconto;
        }

        public function verificaPontos(){
            $qnt_pontos = 0;
            foreach($this->_pontos_milhagem as $ponto){
                $now = new DateTime;
                if($now->getTimestamp() >= $ponto[1]->getTimestamp()){
                    unset($ponto);
                }
                else{
                    $qnt_pontos += $ponto[0];
                }
            }
            return $qnt_pontos;
        }

        public function addPontos(int $valor_ponto, DateTime $validade){
            $now = new DateTime;
            $data_limite = new DateTime;
            $data_limite->setTimestamp( $now->getTimestamp() + $validade->getTimestamp());
            $ponto = [ $valor_ponto , $data_limite];
            array_push($_pontos_milhagem, $ponto);
        }

        public function IsVIP () {
            return true;
          }
    }

