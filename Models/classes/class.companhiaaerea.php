<?php

include_once "../Models/global.php";


class CompanhiaAerea extends persist{
    protected string $_nome;
    protected int $_codigo;
    private string $_cnpj;
    private string $_razao_social;
    protected
    string $_sigla;
    private $_planejamentos = array();
    private $_aeronaves = array();
    private float $_franquia;
    private ProgramaDeMilhagem $_programa_de_milhagem;
    private $_frota = array();
    private $_pilotos = array();
    private $_comissarios = array();
    static $local_filename = "companhias.txt";


    public function __construct (string $nome, int $codigo,  string $cnpj, string $razao, 
                                string $sigla, float $franquia){
        
        $this->_nome = $nome;
        $this->_codigo = $codigo;
        $this->_cnpj = $cnpj;
        $this->_razao_social = $razao;
        verifica_SiglaCompanhia($sigla);
        $this->_sigla = $sigla;
        $this->_franquia = $franquia;
        $this->_programa_de_milhagem = new ProgramaDeMilhagem();
        Usuario::ValidaLogado();
        $mensagem = "Companhia Aérea ".$razao." criada";
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", "null", serialize($this), $mensagem);
        $log->save();
    }
//Programa de Milhagem
    //Cadastrar nova categoria;
    public function CadastrarCategoria (string $nome, int $pnts) {
        $mensagem = "Categoria ".$nome." Cadastrada com valor de ".$pnts;
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", "null", serialize($this), $mensagem);
        $log->save();
        $this->_programa_de_milhagem->setCategoria($nome, $pnts);
    }
    //Exclui uma categoria existente, com base no nome ou quantidade de pontos;
    public function ExcluirCategoria ($parametro) {
        $this->_programa_de_milhagem->excluirCategoria($parametro);//pts ou nome da categoria
    }
    //Cadastra o passageiro VIP no programa de milhagem;
    private function CadastrarPassageiroVip (Vip $passageiro){
        $this->_programa_de_milhagem->setPassageiro($passageiro);


        $mensagem = "Passageiro ".$passageiro->getCadastro()->getNome()." Adicionado ao programa de milhagem de ".$this->_razao_social;
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", "null", serialize($this), $mensagem);
        $log->save();
    }
  //Promove passageiro para VIP, e cadastra no programa de Milhagem;
    public function PromoverVIP (Passageiro $p_vip) {
      $vip = $p_vip->generateVip();
      $this->CadastrarPassageiroVip($vip);
      return $vip;
    }
//Outros

    public function CadastrarComissario(Comissario $comissario){
        array_push($this->_comissarios, $comissario);
    }

    public function CadastrarPiloto(Piloto $piloto){
        array_push($this->_pilotos, $piloto);
    }
    
    public function CadastrarVeiculo (Veiculo $veiculo) {
        array_push($this->_frota, $veiculo);
    }

    public function CadastrarAeronave(Aeronave $aeronave){
        $obj_antes = serialize($this);
        array_push($this->_aeronaves, $aeronave);
        $mensagem ="Aeronave ". $aeronave->getRegistro()." Cadastrada em ".$this->_razao_social;
        $log = new Log_escrita(new DateTime(), "companhia aerea", $obj_antes, serialize($this), $mensagem);
        $log->save();
    }
    
    public function atualizaViagens(){
        for($i = 0; $i<count($this->_planejamentos); $i++){
            $this->_planejamentos[$i]->ProgramaViagens();
        }
    }

    public function addPlanejamento(Planejamento $plan){
        $obj_antes = serialize($this);
        $plan->setCompanhia($this);
        array_push($this->_planejamentos, $plan);
        $mensagem = "Planejamento entre ".$plan->getAeroportoS()." e ".$plan->getAeroportoC(). " adicionado a ".
        $this->_razao_social;
        $log = new Log_escrita(new DateTime(), "Companhia Aerea", $obj_antes, serialize($this), $mensagem);
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
        
        return $this->_aeronaves[0];

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

    public function getCodigo () {
        return $this->_codigo;
    }

    public function getCNPJ () {
        return $this->_cnpj;
    }

    public function getRazao () {
        return $this->_razao_social;
    }

    public function setFranquia (float $franquia) {
        $this->_franquia = $franquia;
    }
    public function getSigla(){
        return $this->_sigla;
    }
    public function getMilhagem(){
        return $this->_programa_de_milhagem;
    }
    public function executaViagem($v){
        foreach($this->_planejamentos as $p){
            if($v->getAeroportoChegada() ==$p->getAeroportoC() && $v->getAeroportoSaida() ==$p->getAeroportoS() ){
                $p->ExecutarViagem($v);
                break;
            }
        }

    }
}