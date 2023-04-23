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
    //private static $tempo_; ?

    public function __construct(string $nome, int $codigo, string $cnpj, 
                                string $razao, string $sigla){
        $this->_nome = $nome;
        $this->_codigo = $codigo;
        $this->_cnpj = $cnpj;
        $this->_razao_social = $razao;
        $this->_sigla = $sigla;
    }
    
    // retorna um array com os planejamentos referentes ao aeroporto de chegada e partida informados
    public function getPlanejamentoFromAeroportos(string $aero_saida = '', string $aero_chegada = ''){
        $planejamentos = array();

        if($aero_saida = '' && $aero_chegada = ''){
            return $this->_planejamentos;
        }
        elseif($aero_chegada = ''){
            foreach($this->_planejamentos as $plans){
                if($plans->getAeroportoS() == $aero_saida){
                    array_push($planejamentos, $plans);
                }
            }
        }
        elseif($aero_saida = ''){
            foreach($this->_planejamentos as $plans){
                if($plans->getAeroportoC() == $aero_chegada){
                    array_push($planejamentos, $plans);
                }
            }
        }
        else{
            foreach($this->_planejamentos as $plans){
                if($plans->getAeroportoC() == $aero_chegada && $plans->getAeroportoS() == $aero_saida){
                        array_push($planejamentos, $plans);
                    }
            }
        }


        if(count($planejamentos) == 0){
            return 0;
        }else{
            return $planejamentos;
        }
        
    }
    
    // public function getPlanejamentoB (string $aero_saida, string $aero_chegada) {
    //     if($this->getPlanejamentoA($aero_saida, $aero_chegada) != 0){
    //         throw new Exception('Há voos diretos entre os aeroportos');
    //     }
        
    //     $planejamentos_saida = array();
    //     $planejamentos_chegada = array();
    //     $v1 = array();
    //     $v2 = array();
    //     foreach($this->_planejamentos as $plans){
    //         if ($plans->getAeroportoS() == $aero_saida ){
    //             array_push($planejamentos_saida, $plans);
    //         }
    //     }
    //     foreach($this->_planejamentos as $plans){
    //         if ($plans->getAeroportoC() == $aero_chegada ){
    //             array_push($planejamentos_chegada, $plans);
    //         }  
    //     }
    // }

    public function addPlanejamento(Planejamento $plan){
        array_push($this->_aeronaves, $plan);
    }

    public function addAeronave(Aeronave $aeronave){
        array_push($this->_aeronaves, $aeronave);
    }

    public function getNome(){
        return $this->_nome;
    }
    
    //retorna todos os plaenjamentos possíveis.
    public function getPLanejamentos(){

        $planejamentos = array();

        foreach( $this->_planejamentos as $plano){

            array_push($planejamentos, $plano);

        }

        return $planejamentos;
    }

    //retorna os planejamentos que saem em determinada data.
    public function getPlanejamentosFromDate(DateTime $data){

        $planejamentos = array();

        foreach($this->_planejamentos as $plano){

            if($plano->getDataS() == $data){

                array_push($planejamentos, $plano);

            }
        }

        return $planejamentos;
    }

}