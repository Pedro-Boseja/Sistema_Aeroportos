<?php
use Vtiful\Kernel\Format;

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
    protected $_cartao = array();
    protected $_status = array();

    public function __construct( Passageiro $passageiro,
                                float $qtde_franquias) {
                                    Usuario::ValidaLogado();

        $this -> _passageiro = $passageiro;
        $this -> _qtde_franquias = $qtde_franquias;
        $this -> _valorfranquia = 0.0;
        array_push($this -> _status, EnumStatus::Passagem_adquirida);
        $log = new Log_escrita(new DateTime(), "Passagem", "null", serialize($this), "Passagem criada");
        $log->save();
    }
    public function ExecutarViagens(){
        $this->_passageiro->Embarcar();

        foreach($this->_viagens as $v){
            if(!in_array(EnumStatus::Checkin_realizado, $this->_status)){
                $v->ViagemExecutada(false);
            }else{
                $v->ViagemExecutada(true);
            }
         
        }
    }
    public function CheckIn () {
        $date_atual = new DateTime("now", new DateTimeZone('America/Bahia'));
        $t = $date_atual->getTimestamp();
    
        $t1 = $this->_viagens[0]->getDataS()->getTimestamp() - 172800; //Data do voo - 2 dias
        $t2 = $this->_viagens[0]->getDataS()->getTimestamp() - 1800; //Data do voo - 30 min
      
        if ($t >= $t1 and $t <= $t2) {
            array_push($this -> _status, EnumStatus::Checkin_realizado);
            echo "Seu check-in foi realizado com sucesso!\n";

            //Parte Cartão de Embarque;
            $i = 0;
            foreach($this->_viagens as $v){
                $nomes = explode(" ", $this->_passageiro->getCadastro()->getNome());
                $nome = $nomes[0];
                $sobrenome = end($nomes);
                $hora = DateTime::createFromFormat("d/M/Y H:i:s", $v->getDataS()->format("d/M/Y H:i:s"));//Subtrair 40 min do horário de saída no horário de embarque
                $horaEmb = $hora->sub(new DateInterval('PT40M'));
                array_push($this->_cartao, new CartaodeEmbarque($nome, $sobrenome, $v->getAeroportoSaida(), 
                    $v->getAeroportoChegada(), $horaEmb, $v->getDataC(), $this->_assentos[$i]));
                $i++;
            }

        } else if ($t < $t1){
            throw new Exception("O periodo de Check-in ainda não começou. Tente mais tarde.\n");
        } else {
            $this->setStatus(EnumStatus::No_show);
            throw new Exception("O periodo de Check-in já foi encerrado hehehehehehe");
        }

        $mensagem = "CheckIn da Passagem do Passageiro ".$this->_passageiro->getCadastro()->getNome()." Realizada";
        $log = new Log_leitura(new DateTime(), "Passagem", "checkIn", $mensagem);
        $log->save();
    }

    public function PrintCartaoEmbarque(){
        $i = 1;
        foreach($this->_cartao as $c){
            echo"\nCartão de embarque ".$i."\n";
            $c->show();
            $i++;
        }

        $mensagem = "Cartões de Embarque Imprimidos";
        $log = new Log_leitura(new DateTime(), "Passagem", "checkIn", $mensagem);
        $log->save();
    }

    public function CancelarPassagem(){
        foreach($this->_viagens as $v){
            $v->CancelarPassageiro($this->_passageiro);
        }
        if($this->_passageiro->IsVIP() && in_array($this->_passageiro, $this->_viagens[0]->_companhia->_programa_de_milhagem->_passageirosvip)){
            echo "Sua passagem foi cancelada sem multas e o valor de ressarcimento foi de R$".$this->_tarifa*count($this->_viagens);
        }else{
            $multa = 0.00;
            foreach($this->_viagens as $v){
                $multa += $v->getMulta();
            }
            echo "A passagem do Passageiro ".$this->_passageiro->getCadastro()->getNome()." foi cancelada e uma multa de R$".$multa." foi cobrada!\n";
            $valor = ($this->_tarifa*count($this->_viagens)/2.0)-$multa;
            echo "O valor pago foi de R$".$this->_tarifa*count($this->_viagens)." e o ressarcimento foi de R$".$valor."\n";
        }
        $this->setStatus(EnumStatus::Passagem_cancelada);

        $mensagem = "Passagem do Passageiro ".$this->_passageiro->getCadastro()->getNome()." Cancelada";
        $log = new Log_leitura(new DateTime(), "Passagem", "checkIn", $mensagem);
        $log->save();
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

    public function setValorFranquia(Viagem $viagem) {
        
        if (!$this->_passageiro->IsVIP()) {
        
            $this->_valorfranquia += $this->_qtde_franquias*$viagem->getFranquia();
            //fazer tratamendo exceção cajo hajam mais de 3 franquias
        }
        else {
            if ($this->_qtde_franquias == 1 or $this->_qtde_franquias == 0) {
                //$this->_valorfranquia += 0;
            }
            else if ($this->_qtde_franquias == 2) {
                $this->_valorfranquia += $viagem->getFranquia()/2.0;
            }
            else if ($this->_qtde_franquias == 3) {
                $this->_valorfranquia += $viagem->getFranquia();
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

        // $viagem->addPassagem($assento, $this);
        // $viagem->save();
        // $assentos = $viagem->getPassageiros();
        // print_r($assentos);

        $mensagem = "Viagem entre ".$viagem->getAeroportoSaida()." e ".$viagem->getAeroportoChegada()." adicionada a passagem do passageiro ". $this->_passageiro->getCadastro()->getNome();
        $log = new Log_leitura(new DateTime(), "Passageiro", "viagens", $mensagem);
        $log->save();


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