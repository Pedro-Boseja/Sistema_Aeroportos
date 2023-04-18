<?php
include_once("class.passagem.php");

class Cliente{
    private string $_nome;
    private int $_idade;
    private string $_identificacao;
    private string $_n_identificacao;
    private $_viagens_compradas = array();
    private $_passagens = array();

    public function __construct(string $nome, int $idade, string $identificacao, 
                                string $n_identificacao) {
        $this -> _nome = $nome;
        $this -> _idade = $idade;
        $this -> _identificacao = strtoupper($identificacao);
        $this -> _n_identificacao = $n_identificacao;
    }

        //array_intersect
    public function SolicitarViagens (string $aeroporto_chegada, string $aeroporto_saida, 
                                    CompanhiaAerea $companhia_aerea, DateTime $data) {
        //Dentro da c.a. verificar se existem voos diretos com esses aeroportos
        //Se não tiver escolher uma viagem com o dado aeroporto de saida e depois achar outra
        //viagem com o mesmo aeroporto de chegada da anterior o aeroporto de saida dao;
        //Mostrar as os horários disponíveis
        //Verificar se ainda existem assentos vazios no avião
        //Se houverem mostrar as opções pro cliente pra ele escolher um
        
        $planos = array();   
        $viagens = array();

        $planos = $companhia_aerea->getPlanejamentoA($aeroporto_saida, $aeroporto_chegada); 

        if(count($planos) == 0){//caso em que não há viagens diretos entre os aeroportos

            $planos = $companhia_aerea->getPlanejamentoB($aeroporto_saida, $aeroporto_chegada);
        
        }else{
            //Para o caso em que há viagens diretas entre os aeroportos, fazer 
            //uma lista e filtrar as viagens que vão acontecer na data especificada e que possuem assentos disponíveis
            foreach($planos as $p){
                foreach($p->getViagensPlanejadas as $vi){
                    
                    if(count($vi->getAssentos()) == $vi->getAeronave()->getCapacidadeP() &&
                       $data->format('d/m/Y') == $vi->getDataS()->format('d/m/Y')){

                        array_push($viagens, $vi);

                    }
                    
                }
            }
        }

        return $viagens;
    }

    public function getNome (){
        return $this -> _nome;
    }

    public function getIdade(){
        return $this -> _idade;
    
    }
    public function getIdentificacao(){
        return $this -> _identificacao;
    }

    public function getNidentificacao(){
        return $this -> _n_identificacao;
    }

    public function setNome(string $nome){
        $this -> _nome = $nome;
    }

    public function setIdade(int $idade){
        $this -> _idade = $idade;
    }

    public function setIdenticacao(string $identificacao){
        $this -> _identificacao = $identificacao;
    }

    public function setNidentificacao(string $n_identificacao){
        $this -> _n_identificacao = $n_identificacao;
    }

}