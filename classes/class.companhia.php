<?php

include_once("class.pmilhagem.php");
include_once("class.veiculo.php");
include_once("class.planejamento.php");
include_once("class.aeronave.php");
include_once("verificacoes.php");
include_once("persist.php");

class CompanhiaAerea extends persist{
    private string $_nome;
    private int $_codigo;
    private string $_cnpj;
    private string $_razao_social;
    private string $_sigla;
    private $_planejamentos = array();
    private $_aeronaves = array();
    private $_franquias = array();
    private ProgramaDeMilhagem $_programa_de_milhagem;
    private $_frota = array();
    static $local_filename = "companhias.txt";
    //private static $tempo_; ?


    public function __construct (string $nome, 
                                int $codigo, 
                                string $cnpj, 
                                string $razao, 
                                string $sigla){
        $this->_nome = $nome;
        $this->_codigo = $codigo;
        $this->_cnpj = $cnpj;
        $this->_razao_social = $razao;
        $this->_sigla = $sigla;
        $this->save();
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

    public function addAeronave(Aeronave $aeronave){
        array_push($this->_aeronaves, $aeronave);
    }

    public function getNome(){
        return $this->_nome;
    }
    
    public function atualizaViagens(){
        foreach($this->_planejamentos as $plan){
            $plan->ProgramaViagens();
        }
    }

    public function addPlanejamento(Planejamento $plan){
        array_push($this->_aeronaves, $plan);
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
            if($plano->getViagemFromDate($data) != null){
                array_push($planejamentos, $plano);
            }
        }
        return $planejamentos;
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

    //Cadastrar nova milhagem ou nova categoria???
    public function CadastrarMilhagem (string $nome, int $pnts) {
        //$categoria = array($nome => $pnts);
        //$this->_programa_de_milhagem->setCategorias($categoria);
    }

    public function PromoverVIP (Passageiro $p_vip) {

    }

    public function CadastraVeiculo (Veiculo $veiculo) {
        array_push($this->_frota, $veiculo);
    }
}