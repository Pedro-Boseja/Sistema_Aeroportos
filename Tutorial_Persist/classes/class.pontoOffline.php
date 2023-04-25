<?php
    //include_once("class.pontoOnline.php");    
    include_once("tipoStatusAprovacao.php"); 

    class pontoOffline extends pontoOnline {
        static $local_filename = "pontoOffline.txt";

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        
        protected TipoStatusAprovacao $statusAprovacao = TipoStatusAprovacao::NA;

        public function __construct( DateTime $p_dataHora  ) {             
            parent::__construct( $p_dataHora );
            
        }     

        public function setStatusAprovacao( TipoStatusAprovacao $p_statusAprovacao ) {
            $this->statusAprovacao = $p_statusAprovacao;
        }
        
    }