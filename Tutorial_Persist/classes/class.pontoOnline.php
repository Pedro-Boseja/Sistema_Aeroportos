<?php
    include_once("tipoPonto.php");    

    class pontoOnline extends persist {
        protected DateTime $dataHora;        
        protected TipoPonto $tipo = TipoPonto::INICIO;
        static $local_filename = "pontoOnline.txt";

        public function __construct( DateTime $p_dataHora ) {             
            $this->dataHora = $p_dataHora;               
        }   

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        
        public function __destruct () { }

        public function setTipo( TipoPonto $p_tipo ) {
            $this->tipo = $p_tipo;
            
        }
        

        
        public function getMonth() {
            return $this->dataHora->format("m");
        }

        public function getYear() {
            return $this->dataHora->format("Y");
        }

        public function getDay() {
            return $this->dataHora->format("d");
        }
    }