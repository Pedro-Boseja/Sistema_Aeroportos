<?php
include_once("class.passagem.php");
include_once("class.viagem.php");
include_once("class.companhia.php");

class Facade{

    //Pegar os planejamentos da companhia referentes ao aeroporto de saida e chagada.
    //Pegar todas as viagens programadas desses planejamentos e filtrar pelas datas.
    //Retorna um array com as viagens possíveis, um array de arrays de 2 dimensões,
    //no caso de haver conexão, ou 0 caso não hajam viagens;
    public static function SolicitarViagemCompanhia(string $aero_c, string $aero_s, DateTime $data, CompanhiaAerea $comp_aerea){

        $planejamentos = array();
        $viagens = array();//array a ser retornado com as possíveis viagens

        //verificar se há viagens diretas entre os aeroportos:
        if($comp_aerea->getPlanejamentoFromAeroportos($aero_s, $aero_c) == 0){//Não há viagens diretas
            $planejamentos_s = $comp_aerea->getPlanejamentoFromAeroportos($aero_s);
            $planejamentos_c = $comp_aerea->getPlanejamentoFromAeroportos('', $aero_c);
            $viagens_s = array();
            $viagens_c = array();

            //Pega todas as viagens de saida e de chegada de uma companhia
            foreach($planejamentos_s as $plans){
                foreach($plans->getViagensPLanejadas() as $vi){
                    if($data->format('d/m/Y') == $vi->getDataS()->format('d/m/Y')){
                        array_push($viagens_s, $vi);
                    }   
                }
            }
            foreach($planejamentos_c as $plans){
                foreach($plans->getViagensPLanejadas() as $vi){
                
                    array_push($viagens_c, $vi);
                }
            }

            //percorre o array de viagens de saida e verifica qual chegada é saida do array de viagens de chegada
            //A conexão só será válida se a diferença entre o hoŕario de chagada e saída for de
            //no mínimo 1 hora e no máximo 6 horas;
            foreach($viagens_s as $vs){
                if(count($vs->getAssentosLivres()) == 0){
                    continue;
                }
                foreach($viagens_c as $vc){
                    if(count($vc->getAssentosLivres()) == 0){
                        continue;
                    }
                    $diff = date_diff($vs->getDataC, $vc->getDataS);
                    $sinal = $diff->format('%R');
                    $diff_dias = intval($diff->format('%R%a'));
                    $diff_horas = intval($diff->format('%R%h'));
                    // $diff_minutos = intval($diff->format('%R%i'));

                    if( $vc->getAeroportoSaida() == $vs->getAeroportoChegada() &&
                        $sinal == '+' && $diff_dias < 0 && $diff_horas >= 1 && $diff_horas <= 3){
                            $arr = array($vs, $vc);
                            array_push($viagens, $arr);
                    }
                }
            }



        }
        else{
            $planejamentos = $comp_aerea->getPlanejamentoFromAeroportos($aero_s, $aero_c);
            foreach($planejamentos as $plans){
                foreach($plans->getViagensPLanejadas() as $vi){
                    if($data->format('d/m/Y') == $vi->getDataS()->format('d/m/Y')){
                        array_push($viagens, $vi);
                        break;
                    }
                    
                }
            }
        }
        
        if(count($viagens) == 0){
            return 0;
        }else{
            return $viagens;
        }

    }

    public static function ComprarPassagem(){
        //criar passageiro ou pegar um já existente no banco de dados
    }


}