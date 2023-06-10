<?php

include_once "../global.php";


class Log_escrita extends Log{


    private string $_entidade;
    private string $_obj_antes;
    private string $_obj_depois;


    public function __construct( DateTime $data_hora,
                                 string $entidade,
                                 string $obj_antes,
                                 string $obj_depois){

                                    Usuario::ValidaLogado();
        $this->_usuario = Usuario::$logado;
        $this->_data_hora = $data_hora;
        $this->_entidade = $entidade;
        $this->_obj_depois = $obj_depois;
        $this->_obj_antes = $obj_antes;

    }



}