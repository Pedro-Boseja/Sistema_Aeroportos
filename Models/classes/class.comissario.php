<?php

include_once "../global.php";


class Comissario extends Tripulante{

    static $local_filename = "comissarios.txt";

    public function __construct(Cadastro $cadastro, $data_nascimento, $nacionalidade, $email, string $documento, string $endereco, CompanhiaAerea $companhia, Aeroporto $aeroporto, $numero_cpf = "VAZIO"){
        Usuario::ValidaLogado();
        $this->_cadastro = $cadastro;
        $this->_cadastro->fillTripulante($data_nascimento, $nacionalidade, $numero_cpf, $email, $documento, $endereco);
        $this->_companhia = $companhia;
        $this->_aeroporto_base = $aeroporto;
        $this->_companhia->CadastrarComissario($this);
        $mensagem = "Comissario ". $cadastro->getNome()." Cadastrado em ".$this->_companhia->getRazao();
        $log = new Log_escrita(new DateTime(), "Piloto", "null", serialize($this), $mensagem);
        $log->save();
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}