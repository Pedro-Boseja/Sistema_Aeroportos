<?php

include_once "../Models/global.php";

class CompanhiaAerea extends persist{
    private string $_nome;
    private int $_codigo;
    private string $_cnpj;
    private string $_razao_social;
    private string $_sigla;
    private $_planejamentos = array();
    private $_aeronaves = array();
    private float $_franquia;
    private ProgramaDeMilhagem $_programa_de_milhagem;
    private $_frota = array();
    private $_pilotos = array();
    private $_comissarios = array();
    static $local_filename = "companhias.txt";


    public function __construct (string $nome, int $codigo,  string $cnpj, string $razao, 
                                string $sigla,
                                float $franquia){
        
        $this->_nome = $nome;
        $this->_codigo = $codigo;
        $this->_cnpj = $cnpj;
        $this->_razao_social = $razao;
        $this->_sigla = $sigla;
        $this->_franquia = $franquia;
        Usuario::ValidaLogado();
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", "null", serialize($this));
        $log->save();
    }
//Programa de Milhagem
    //Cadastrar nova categoria;
    public function CadastrarCategoria (string $nome, int $pnts) {
        $this->_programa_de_milhagem->setCategoria($nome, $pnts);
    }
    //Exclui uma categoria existente, com base no nome ou quantidade de pontos;
    public function ExcluirCategoria ($parametro) {
        $this->_programa_de_milhagem->excluirCategoria($parametro);//pts ou nome da categoria
    }
    //Cadastra o passageiro VIP no programa de milhagem;
    public function CadastrarPassageiroMilhagem (Vip $passageiro){
        $this->_programa_de_milhagem->setPassageiro($passageiro);
    }
//Outros
    public function CadastrarComissario(Comissario $comissario){
        array_push($this->_comissarios, $comissario);
    }

    public function CadastrarPiloto(Piloto $piloto){
        array_push($this->_pilotos, $piloto);
    }
    
    public function CadastraVeiculo (Veiculo $veiculo) {
        array_push($this->_frota, $veiculo);
    }

    public function CadastrarAeronave(Aeronave $aeronave){
        $obj_antes = serialize($this);
        array_push($this->_aeronaves, $aeronave);
        $log = new Log_escrita(new DateTime(), "companhia aerea", $obj_antes, serialize($this));
        $log->save();
    }

    public function PromoverVIP (Passageiro $p_vip) {
        $p_vip = new Vip($p_vip);
    }
    
    public function atualizaViagens(){
        foreach($this->_planejamentos as $plan){
            $plan->ProgramaViagens();
        }
    }

    public function addPlanejamento(Planejamento $plan){
        $obj_antes = serialize($this);
        $plan->setCompanhia($this);
        array_push($this->_aeronaves, $plan);
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", $obj_antes, serialize($this));
        $log->save();
    }
    
    static public function getFilename() {
        return get_called_class()::$local_filename;
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

    public function getAeronavesDisponiveis(){

    }

    public function getPilotosDisponiveis(){
        
    }

    public function getComissariosDisponiveis(){
        
    }

    public function getVeiculosDisponiveis(){
        
    }

    public function getFranquia () {
        return $this->_franquia;
    }

    public function setFranquia (float $franquia) {
        $this->_franquia = $franquia;
    }
    public function getSigla(){
        return $this->_sigla;
    }
}