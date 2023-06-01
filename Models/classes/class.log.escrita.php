<?php

include_once "..global.php";

class Log_escrita extends Log{


    private string $_entidade;
    private string $_obj_antes;
    private string $_obj_depois;

    static $local_filename = "logs.txt";

    public function __construct(Usuario $usuario,
                                 DateTime $data_hora,
                                 string $entidade,
                                 string $obj_antes,
                                 string $obj_depois){


        $this->_usuario = $usuario;
        $this->_data_hora = $data_hora;
        $this->_entidade = $entidade;
        $this->_obj_depois = $$obj_depois;
        $this->_obj_antes = $$obj_antes;

    }

    static public function getFilename(){

        return get_called_class()::$local_filename;
    }


}