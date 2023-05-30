<?php  
    class disciplina extends persist {
        protected string $nome;
        protected int $codigo;

        protected static $local_filename = "disciplina.txt";

        public function __construct( $p_codigo, $p_nome = 'N/D' ) {             
            $this->codigo = $p_codigo;
            $this->nome = $p_nome;
        }        

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        
       
    }