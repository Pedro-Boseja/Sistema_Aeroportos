<?php

include_once "../global.php";

class ProgramaDeMilhagem{
    private $_categorias=array();
    private $_passageirosvip=array();
    public function __construct(){
        $this->_categorias[0]="Sem Categoria";
    } 
    public function Upgrade (Vip $passageiro){
        $chave = -1;
        foreach ($this->_passageirosvip as $key => $value) {
            if($value[0] == $passageiro){
                $chave = $key;
                break;
            }
        }
        $this->_passageirosvip[$chave][1] = $this->getCategoria($passageiro->verificaPontos());
    }
    public function Downgrade(){
        $this->_passageirosvip;
        foreach ($this->_passageirosvip as $key => $value) {
            if($value[1] != $this->getCategoria($value[0]->verificaPontos())){
                $this->_passageirosvip[$key][1] =  $this->getCategoria($value[0]->verificaPontos());
            }
        }
    }
    public function getCategoria(int $pontos){
        $c=''; //categoria (valor)
        $p=0; //pontuação (chave)
        foreach ($this->_categorias as $chave => $valor) {
            if($chave<=$pontos && $chave<=$p){
                $c = $chave;
                $p = $valor;
            }
        }
        return $c;
    }
    public function setCategoria(string $nome, int $pontos){
        $this->_categorias[$pontos]=$nome;
    }
    public function setPassageiro(Vip $passageiro){
        array_push($this->_passageirosvip, array($passageiro,$this->getCategoria($passageiro->verificaPontos())));
    }
}