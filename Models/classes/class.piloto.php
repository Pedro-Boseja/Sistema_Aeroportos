<?php

include_once "../Models/global.php";


class Piloto extends Tripulante{

    static $local_filename = "pilotos.txt";

    public function __construct(Cadastro $cadastro, $data_nascimento, $nacionalidade, $email, string $documento, string $endereco, CompanhiaAerea $companhia, Aeroporto $aeroporto, $numero_cpf = "VAZIO"){
        Usuario::ValidaLogado();
        $this->_cadastro = $cadastro;
        $this->_cadastro->fillTripulante($data_nascimento, $nacionalidade, $numero_cpf, $email, $documento, $endereco);
        $this->_companhia = $companhia;
        $this->_aeroporto_base = $aeroporto;
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}