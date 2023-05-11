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
    
    protected float $_tarifa;
    protected Viagem $_viagem;
    protected string $_assento;
    protected $_franquias = array();
    protected Passageiro $_passageiro;
    protected $_status = array();

    public function __construct(float $tarifa, Viagem $viagem, 
                                string $assento, Passageiro $passageiro) {
        $this -> _tarifa = $tarifa;
        $this -> _viagem = $viagem;
        $this -> _assento = $assento;
        $this -> _passageiro = $passageiro;
        array_push($this -> _status, EnumStatus::Passagem_adquirida);
    }

    public function CheckIn () {

        $date_atual = new DateTime("now", new DateTimeZone('America/Bahia'));
        $t = $date_atual->getTimestamp();
    
        $t1 = $this->_viagem->getDataS()->getTimestamp() - 172800; //Data do voo - 2 dias
        $t2 = $this->_viagem->getDataS()->getTimestamp() - 1800; //Data do voo - 30 min
      
        if ($t >= $t1 and $t <= $t2) {
            array_push($this -> _status, EnumStatus::Checkin_realizado);
            echo 'Seu check-in foi realizado com sucesso!';
        } else if ($t < $t1){
            echo 'O periodo de Check-in ainda não começou. Tente mais tarde.';
        } else {
            echo 'O periodo de Check-in já foi encerrado hehehehehehe';
        }
    }

    public function getTarifa() {
        return $this -> _tarifa;
    }

    public function getViagem() {
        return $this -> _viagem;
    }

    public function getAssento() {
        return $this -> _assento;
    }

    public function getPassageiro() {
        return $this -> _passageiro;
    }

    public function getStatus() {
      return $this -> _status;
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

    public function setViagem(Viagem $viagem) {
        $this -> _viagem = $viagem;
    }
    public function setAssento(string $assento) {
        $this -> _assento = $assento;
    }

    public function setFranquia(float $franquia) {
        array_push($this->_franquias, $franquia);
    }

    public function setPassageiro (Passageiro $passageiro) {
        $this -> _passageiro = $passageiro;
    }

    public function setStatus ($status) {
        array_push($this->_status, $status);
    }
}