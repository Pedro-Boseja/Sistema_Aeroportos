<?php

include_once("class.viagem.php");

class Passagem 
{
    protected float $_tarifa;
    protected Viagem $_viagem;
    protected string $_assento;
    protected float $_franquia;

    public function __construct(float $tarifa, Viagem $viagem, string $assento, float $franquia){
        $this -> _tarifa = $tarifa;
        $this -> _viagem = $viagem;
        $this -> _assento = $assento;
        $this -> _franquia = $franquia;
    }

    public function getTarifa(){
        return $this -> _tarifa;
    }

    public function getViagem(){
        return $this -> _viagem;
    }

    public function getAssento(){
        return $this -> _assento;
    }

    public function getFranquia(){
        return $this -> _franquia;
    }

    public function set_Tarifa(float $tarifa){
        $this -> _tarifa = $tarifa;
    }

    public function set_Viagem(Viagem $viagem){
        $this -> _viagem = $viagem;
    }
    public function set_Assento(string $assento){
        $this -> _assento = $assento;
    }

    public function set_Franquia(float $franquia){
        $this -> _franquia = $franquia;
    }
}
        