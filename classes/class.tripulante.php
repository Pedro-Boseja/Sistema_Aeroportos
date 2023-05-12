<?php

include_once "../global.php";

class Tripulante extends persist{

    protected Cadastro $_cadastro;
    private Aeroporto $_aeroporto_base;
    private CompanhiaAerea $_companhia;
    private $viagens_planejadas = array();
    static $local_filename = "tripulantes.txt";

    public function __construct(Cadastro $cadastro, $data_nascimento, $nacionalidade, $email, string $documento, string $endereco, CompanhiaAerea $companhia, Aeroporto $aeroporto, $numero_cpf = "VAZIO"){
        $this->_cadastro = $cadastro;
        $this->_cadastro->fillTripulante($data_nascimento, $nacionalidade, $numero_cpf, $email, $documento, $endereco);
        $this->_companhia = $companhia;
        $this->_aeroporto_base = $aeroporto;
        $this->save();

    }
    
    static public function getFilename() {
        return get_called_class()::$local_filename;
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

    public function setAeroporto(Aeroporto $aeroporto){
        $this -> _aeroporto_base = $aeroporto;
    }

    public function setCompanhia(CompanhiaAerea $companhia){
        $this -> _companhia = $companhia;
    }

}