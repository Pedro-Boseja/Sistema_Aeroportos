<?php  
    //include_once('persist.php');
    abstract class pessoa extends persist  {
        protected string $nome;
        protected int $cpf;
        
        public function __construct( string $p_nome, int $p_cpf ) { 
            if ( ! $this->validaCPF($p_cpf) ) {
                throw new Exception("CPF inválido");
            }
            else {            
                $this->nome = $p_nome;
                $this->cpf = $p_cpf;
            }
        }   
        
        private function validaCPF( int $p_cpf ) {
            return true;
        }

        public function __destruct(  ) {             
            
        }   
        
        abstract public function printMe(  );
       
    }