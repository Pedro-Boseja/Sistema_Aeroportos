<?php

include_once "../global.php";


class Log_escrita extends Log{


    private string $_entidade;
    private string $_obj_antes;
    private string $_obj_depois;


    public function __construct( DateTime $data_hora,
                                 string $entidade,
                                 string $obj_antes,
                                 string $obj_depois, string $mensagem){

        Usuario::ValidaLogado();
        parent::__construct($data_hora, $mensagem);

        $this->_entidade = $entidade;
        $this->_obj_depois = $obj_depois;
        $this->_obj_antes = $obj_antes;                               
    }



}