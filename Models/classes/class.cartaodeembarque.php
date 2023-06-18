<?php

include_once "../global.php";


class CartaodeEmbarque{
    private string $_nome;
    private string $_sobrenome;
    private string $_origemVoo;
    private string $_destinoVoo;
    private DateTime $_horarioEmbarque;
    private DateTime $_horarioChegada;
    private string $_assento;

    public function __construct($nome, $sobrenome, $origemVoo, $destinoVoo, $horarioEmbarque, $horarioChegada, $assento){
        Usuario::ValidaLogado();
        if($horarioEmbarque->getTimestamp() > $horarioChegada->getTimestamp()){
            throw new Exception("Horários escolhidos inválidos\n");
        }
        $this->_nome = $nome;
        $this->_sobrenome = $sobrenome;
        $this->_origemVoo = $origemVoo;
        $this->_destinoVoo = $destinoVoo;
        $this->_horarioEmbarque = $horarioEmbarque;
        $this->_horarioChegada = $horarioChegada;
        $this->_assento = $assento;
        $log = new Log_escrita(new DateTime(), "Cartao de Embarque", "null", serialize($this), "Cartão de embarque criado");
        $log->save();
    }

    public function getNome (){
        return $this->_nome;
    }
    public function getSobrenome (){
        return $this->_sobrenome;
    }
    public function getOrigemVoo (){
        return $this->_origemVoo;
    }
    public function getDestinoVoo (){
        return $this->_destinoVoo;
    }
    public function getHorarioEmbarque (){
        return $this->_horarioEmbarque;
    }
    public function getHorarioChegada (){
        return $this->_horarioChegada;
    }
    public function getAssento (){
        return $this->_assento;
    }
    public function setNome ($nome){
        $this->_nome = $nome;
    }
    public function setSobrenome ($sobrenome){
        $this->_sobrenome = $sobrenome;
    }
    public function setOrigemVoo ($origemVoo){
        $this->_origemVoo = $origemVoo;
    }
    public function setDestinoVoo ($destinoVoo){
        $this->_destinoVoo = $destinoVoo;
    }
    public function setHorarioEmbarque ($horarioEmbarque){
        $this->_horarioEmbarque = $horarioEmbarque;
    }
    public function setHorarioChegada ($horarioChegada){
        $this->_horarioChegada = $horarioChegada;
    }
    public function setAssento ($assento){
        $this->_assento = $assento;
    }
    public function show(){
        echo"______________________________\n";
        echo "Passageiro: ".$this->_nome . " " . $this->_sobrenome . "\n";
        echo "Origem: ".$this->_origemVoo . "\n";
        echo "Destino: ".$this->_destinoVoo . "\n";
        echo "Horario do Embarque: ".$this->_horarioEmbarque->format("d/M/Y H:i:s") . "\n";
        echo "Horario de chegada: ".$this->_horarioChegada->format("d/M/Y H:i:s") . "\n";
        echo "Assento: ".$this->_assento . "\n";
        echo"______________________________\n";
    }
}