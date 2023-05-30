<?php

include_once "../Models/global.php";

class Piloto extends Tripulante{

    static $local_filename = "pilotos.txt";

    public function __construct(Cadastro $cadastro){
        $this->_cadastro = $cadastro;
        $this->save();

    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}