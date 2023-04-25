<?php
    include_once("class.pessoa.php");   
    class aluno extends pessoa {
        private int $matricula = 0;

        public function __construct( string $p_nome, $p_cpf  ) {             
            parent::__construct($p_nome, $p_cpf);
            
        }      
        
        public function setMatricula( $p_matricula ) {
            $this->matricula = $p_matricula;
        }
        
        public function printMe() {
            echo "\nNome: ".$this->nome;
            echo "\nCPF: ".$this->cpf;
            echo "\nMatrícula: ".$this->matricula."\n";
        }
        
        static public function getFilename() {
            return 'aluno.txt';
        }
       
    }