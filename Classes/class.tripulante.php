<?php

include_once "class.passageiro.php";

class Tripulante extends Passageiro{

    private Aeroporto $_aeroporto_base;
    private string $_companhia;

    public function __construct(Cadastro $cadastro, string $documento, string $endereco){
        $this->_cadastro = $cadastro;
        $cadastro->fillTripulante($documento, $endereco);
    }

    public function getCadastro(){
        return $this->_cadastro;
    }

    public function getAeroporto(){
        return $this->_aeroporto_base;
    }

    public function getCompanhia(){
        return $this->_companhia;
    }

    public function setAeroportp(Aeroporto $aeroporto){
        $this -> _aeroporto_base = $aeroporto;
    }

    public function setCompanhia(string $companhia){
        $this -> _companhia = $companhia;
    }

}