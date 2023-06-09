<?php

include_once "../global.php";


class Comissario extends Tripulante{

    static $local_filename = "comissarios.txt";

    public function __construct(Cadastro $cadastro){
        Usuario::ValidaLogado();
        $this->_cadastro = $cadastro;
    }

    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

}