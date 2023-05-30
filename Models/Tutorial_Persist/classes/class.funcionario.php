<?php
    //include_once("class.pontoOnline.php"); 
    define("x", 1);
    //$x = 1;  
    class funcionario extends persist {
        protected string $nome;
        protected int $cpf;
        protected $registroPontos = array();
        private  int $jornadaDiaria = 8;
        static $local_filename = "funcionario.txt";

        public function __construct( string $p_nome, int $p_cpf ) {
            $this->nome = $p_nome;
            $this->cpf = $p_cpf;
        }

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }

        public function addPonto ( pontoOnline $p_ponto ) {
            $ano = $p_ponto->getYear();
            $mes = $p_ponto->getMonth();
            $dia = $p_ponto->getDay();

            if ( !isset( $this->registroPontos[$ano] ) )
                $this->registroPontos[$ano] = array();

            if ( !isset( $this->registroPontos[$ano][$mes] ) )
                $this->registroPontos[$ano][$mes] = array();

            if ( !isset( $this->registroPontos[$ano][$mes][$dia] ) )
                $this->registroPontos[$ano][$mes][$dia] = array();
            

            array_push( $this->registroPontos[$ano][$mes][$dia], $p_ponto );
        }

        public function printPontos() {
            print_r( $this->registroPontos );
        }


    }