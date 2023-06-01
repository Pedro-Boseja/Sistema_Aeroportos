<?php

include_once "../Models/global.php";

class Comissario extends Tripulante{

    static $local_filename = "comissarios.txt";

    public function __construct(Cadastro $cadastro){
        $this->_cadastro = $cadastro;
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}