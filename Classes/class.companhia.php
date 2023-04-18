<?php
    include_once("class.planejamento.php");
    include_once("class.aeronave.php");
    include_once("../verificacoes.php");

    class CompanhiaAerea {
        private string $_nome;
        private int $_codigo;
        private string $_cnpj;
        private string $_razao_social;
        private string $_sigla;
        private $_planejamentos = array();
        private $_aeronaves = array();
        private $_franquias = array();

        public function __construct(string $nome, int $codigo, string $cnpj, 
                                    string $razao, string $sigla){
            $this->_nome = $nome;
            $this->_codigo = $codigo;
            $this->_cnpj = $cnpj;
            $this->_razao_social = $razao;
            $this->_sigla = $sigla;
        }
        
        // retorna um array com os planejamentos referentes ao aeroporto de chegada e partida informados
        public function getPlanejamentoA (string $aero_saida, string $aero_chegada){
            $planejamentos = array();
            foreach($this->_planejamentos as $plans){
                if($plans->getAeroportoC->getSigla() == $aero_chegada &&
                   $plans->getAeroportoS->getSigla() == $aero_saida){
                        array_push($planejamentos, $plans);
                    }
            }
            return $planejamentos;
        }
        
        public function getPlanejamentoB (string $aero_saida, string $aero_chegada) {
            $planejamentos_saida = array();
            $planejamentos_chegada = array();
            foreach($this->_planejamentos as $plans){
                if ($plans->getAeroportoS() == $aero_saida ){
                    array_push($planejamentos_saida, $plans);
                }
            }
            foreach($this->_planejamentos as $plans){
                if ($plans->getAeroportoC() == $aero_chegada ){
                    array_push($planejamentos_chegada, $plans);
                }
            }
            
        }

        public function addPlanejamento(Planejamento $plan){
            array_push($this->_aeronaves, $plan);
        }

        public function addAeronave(Aeronave $aeronave){
            array_push($this->_aeronaves, $aeronave);
        }

    
        public function getNome(){
            return $this->_nome;
        }
        
    }