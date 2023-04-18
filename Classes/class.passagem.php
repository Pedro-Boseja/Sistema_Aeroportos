<?php

include_once("class.viagem.php");
include_once("class.passageiro.php");

enum EnumStatus { //utilizado para determinar o status da passagem
  case Passagem_adquirida;
  case Passagem_cancelada; 
  case Checkin_realizado;
  case Embarque_realizado;
  case No_show;
  }

class Passagem  {
    
    protected float $_tarifa;
    protected Viagem $_viagem;
    protected string $_assento;
    protected $_franquias = array();
    protected Passageiro $_passageiro;
    protected $_status = array();

    public function __construct(float $tarifa, Viagem $viagem, string $assento, Passageiro $passageiro) {
        $this -> _tarifa = $tarifa;
        $this -> _viagem = $viagem;
        $this -> _assento = $assento;
        $this -> _passageiro = $passageiro;
        array_push($this -> _status, EnumStatus::Passagem_adquirida);
    }

    public function CheckIn () {
        $date_atual = new DateTime;
        $time_1_viagem = $this->_viagem->getDataS();
        $time_1_viagem->date_modify('-2 day');
        $time_2_viagem = $this->_viagem->getDataS();
        $time_2_viagem->date_modify('-30 minute');
        if ($date_atual->format('d/m/Y/H/i') >= $time_1_viagem && 
            $date_atual->format('d/m/Y/H/i') <= $time_2_viagem) {
                array_push($this -> _status, EnumStatus::Checkin_realizado);
            } else if ($date_atual->format('d/m/Y/H/i') < $time_1_viagem){
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
        $this -> _franquia = $franquia;
    }

    public function setPassageiro (Passageiro $passageiro) {
        $this -> _passageiro = $passageiro;
    }

    public function setStatus ($status) {
        array_push($this->_status, $status);
    }
}
        