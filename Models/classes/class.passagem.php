<?php

include_once "../global.php";


enum EnumStatus : string { //utilizado para determinar o status da passagem
  case Passagem_adquirida = "passagem adquirida";
  case Passagem_cancelada = "passagem cancelada"; 
  case Checkin_realizado = "check in realizado";
  case Embarque_realizado = "embarque realizado";
  case No_show = "não apareceu";
}

class Passagem  {
    
    protected float $_tarifa = 1000;
    protected $_viagens = array();
    protected $_assentos = array();
    protected int $_qtde_franquias;
    protected float $_valorfranquia;
    protected Passageiro $_passageiro;
    protected CartaodeEmbarque $_cartao = array();
    protected $_status = array();

    public function __construct( Passageiro $passageiro,
                                float $qtde_franquias) {
                                    Usuario::ValidaLogado();

        $this -> _passageiro = $passageiro;
        $this -> _qtde_franquias = $qtde_franquias;
        $this -> _valorfranquia = 0.0;
        array_push($this -> _status, EnumStatus::Passagem_adquirida);
    }

    public function CheckIn () {
        $date_atual = new DateTime("now", new DateTimeZone('America/Bahia'));
        $t = $date_atual->getTimestamp();
    
        $t1 = $this->_viagens[0]->getDataS()->getTimestamp() - 172800; //Data do voo - 2 dias
        $t2 = $this->_viagens[0]->getDataS()->getTimestamp() - 1800; //Data do voo - 30 min
      
        if ($t >= $t1 and $t <= $t2) {
            array_push($this -> _status, EnumStatus::Checkin_realizado);
            echo 'Seu check-in foi realizado com sucesso!';

            //Parte Cartão de Embarque;
            foreach($this->_viagens as $v){
                array_push($this->_cartao, new CartaodeEmbarque($this->getPassageiro()->getCadastro()->getNome(), 
                    $this->getPassageiro()->getCadastro()->getNome(), $v->getAeroportoSaida(), 
                    $v->getAeroportoChegada(), $v->getHorarioS() - 2400, $v->getHorarioC(), $this->_assentos));//Subtrair 40 min do horário de saída no horário de embarque
            }

        } else if ($t < $t1){
            echo 'O periodo de Check-in ainda não começou. Tente mais tarde.';
        } else {
            echo 'O periodo de Check-in já foi encerrado hehehehehehe';
        }
    }

    public function CancelarPassagem(){
        foreach($this->_viagens as $v){
            $v->CancelarPassageiro($this->_passageiro);
        }
        if($this->_passageiro->IsVIP() && in_array($this->_passageiro, $this->_viagens[0]->_companhia->_programa_de_milhagem->_passageirosvip)){
            echo "Sua passagem foi cancelada.";
        }else{
            foreach($this->_viagens as $v){
                echo "Foi cobrado uma multa do passageiro ". $this->_passageiro->getCadastro()->getNome()." de R$". $v->getMulta() . "." ;
            }
            echo "Sua passagem foi cancelada.";
        }
        return;
    }

    public function getTarifa() {
        return $this -> _tarifa;
    }

    public function getViagens() {
        return $this -> _viagens;
    }

    public function getAssentos() {
        return $this -> _assentos;
    }

    public function getPassageiro() {
        return $this -> _passageiro;
    }

    public function getStatus() {
      return $this -> _status;
    }

    public function getQtdeFranquias() {
        return $this -> _qtde_franquias;
    }

    public function getValorFranquia() {
        return $this -> _valorfranquia;
    }

    public function getStrStatus() {
      $status = array();
      foreach($this->_status as $str) {
        array_push($status, $str->value);
      }
      return $status;
    }

    public function setTarifa(float $tarifa) {
      $this -> _tarifa = $tarifa;
    }

    public function setValorFranquia($viagem) {
        
        if (!$this->_passageiro->IsVIP()) {
            $this->_valorfranquia += $this->_qtde_franquias*$viagem->getCompanhia()->getFranquia();
            //fazer tratamendo exceção cajo hajam mais de 3 franquias
        }
        else {
            if ($this->_qtde_franquias == 1 or $this->_qtde_franquias == 0) {
                //$this->_valorfranquia += 0;
            }
            else if ($this->_qtde_franquias == 2) {
                $this->_valorfranquia += $viagem->getCompanhia()->getFranquia()/2.0;
            }
            else if ($this->_qtde_franquias == 3) {
                $this->_valorfranquia += $viagem->getCompanhia()->getFranquia();
            }
            else {
                //mudar para tratamento de exceção
                echo 'Não é possível ter mais de 3 franquias. Selecione outra quantidade';
            }
        }     
    }

    public function setPassageiro (Passageiro $passageiro) {
        $this -> _passageiro = $passageiro;
    }

    public function setStatus ($status) {
        array_push($this->_status, $status);
    }

    public function addViagem (Viagem $viagem, string $assento) {
        $this->_tarifa = $viagem->getTarifa();
        array_push($this->_viagens, $viagem);
        array_push($this->_assentos, $assento);
        $this->setValorFranquia($viagem);
    }

    public function inicioDaViagem(){
        $tempo=0;
        $agora = new DateTime();
        foreach($this->_viagens as $v){
            $d = ($v->getDataS())->diff($agora); //Calcula o tempo que falta para iniciar primeira viagem
            if($tempo==0){
                $tempo=$d->h;
            }else{
                if($tempo>=$d->h){
                    $tempo=$d->h;
                }
            }
        }
        return $tempo;
    }
}