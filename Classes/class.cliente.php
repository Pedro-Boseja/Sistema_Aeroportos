<?php
include_once("class.passagem.php");
include_once("class.cadastro.php");

class Cliente{
    private Cadastro $_cadastro;
    private $_viagens_compradas = array();
    private $_passagens = array();

    public function __construct(Cadastro $cadastro) {
        $this -> _cadastro = $cadastro;
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
  public function CancelarViagem (Passagem $passagem){
    if(in_array(EnumStatus::Passagem_adquirida, $passagem->getStatus)){
        if(in_array(EnumStatus::Passagem_cancelada, $passagem->getStatus)){
          echo "A passagem já foi cancelada";
        }else
        if(in_array(EnumStatus::Checkin_realizado, $passagem->getStatus)){
          echo "A passagem não pode ser cancelada";
        }else{
          $passagem->setStatus(EnumStatus::Passagem_cancelada);
        }
    }  
  }

}