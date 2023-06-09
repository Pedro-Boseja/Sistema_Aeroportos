<?php

include_once "../global.php";


class Piloto extends Tripulante{

    static $local_filename = "pilotos.txt";

    public function __construct(Cadastro $cadastro){
        Usuario::ValidaLogado();
        $this->_cadastro = $cadastro;
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}