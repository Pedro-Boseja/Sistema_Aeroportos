<?php

include_once "../global.php";


    class Vip extends Passageiro{

        private int $_n_registro;

        private float $_desconto;

        private $_pontos_milhagem = array();

        static $local_filename = "passageirosVip.txt";

        public function __construct(Passageiro $passageiro){
            Usuario::ValidaLogado();
            $nascimento = $passageiro->getCadastro()->getDataNascimento();
            $nacio = $passageiro->getCadastro()->getNacionalidade();
            $email = $passageiro->getCadastro()->getEmail();
            $cpf = $passageiro->getCadastro()->getNumeroCpf();

            parent::__construct($passageiro->getCadastro(), $nascimento, $nacio, $email, $cpf);
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
                $now = new DateTime();
                if($now->getTimestamp() >= $ponto[1]->getTimestamp()){
                    //echo "unset";
                    unset($ponto);
                }
                else{
                    //echo "Soma".$ponto[1]->getTimestamp()." é ".$now->getTimestamp()."\n";
                    $qnt_pontos += $ponto[0];
                }
            }
            return $qnt_pontos;
        }

        public function addPontos(int $valor_ponto, DateTime $validade=null/*validade padrão 1ano*/){
            /*$now = new DateTime;
            $data_limite = new DateTime; //Isso não funcionava
            $data_limite->setTimestamp( $now->getTimestamp() + $validade->getTimestamp());*/
            if($validade==null){
              $validade = new Datetime();
              $validade->add(new DateInterval('P1Y'));
            }
            $ponto = [ $valor_ponto , $validade];
            array_push($this->_pontos_milhagem, $ponto);
        }

        public function IsVIP () {
            return true;
          }
        
    }

