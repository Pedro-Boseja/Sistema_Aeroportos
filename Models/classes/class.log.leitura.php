<?php

include_once "..global.php";

class Log_leitura extends Log{


    protected $_entidade;
    protected $_info;

    static $local_filename = "logsLeitura.txt";

    public function __construct(DateTime $data_hora,
                                 string $entidade,
                                 string $info){
        Usuario::ValidaLogado();
        $this->_usuario = Usuario::$logado;
        $this->_data_hora = $data_hora;
        $this->_entidade = $entidade;
        $this->_info = $info;

    }

    static public function getFilename(){

        return get_called_class()::$local_filename;
    }


}