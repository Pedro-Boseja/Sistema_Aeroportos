<?php

include_once "../Models/global.php";

enum EnumStatus : string { //utilizado para determinar o status da passagem
  case Passagem_adquirida = "passagem adquirida";
  case Passagem_cancelada = "passagem cancelada"; 
  case Checkin_realizado = "check in realizado";
  case Embarque_realizado = "embarque realizado";
  case No_show = "não apareceu";
}

class Passagem  {
    
    protected float $_tarifa;
    protected $_viagens = array();
    protected $_assentos = array();
    protected int $_qtde_franquias;
    protected float $_valorfranquia;
    protected $_passageiro;
    protected $_status = array();

    public function __construct(float $tarifa,  
                                Passageiro $passageiro,
                                float $qtde_franquias) {
                                    Usuario::ValidaLogado();
        $this -> _tarifa = $tarifa;
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
        array_push($this->_viagens, $viagem);
        array_push($this->_assentos, $assento);
        $this->setValorFranquia($viagem);
    }
}