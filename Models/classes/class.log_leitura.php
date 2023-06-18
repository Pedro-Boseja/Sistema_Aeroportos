<?php
include_once "../Models/global.php";


class Log_leitura extends Log{


    protected $_entidade;
    protected $_info;

    public function __construct(DateTime $data_hora,
                                 string $entidade,
                                 string $info, string $mensagem){
        Usuario::ValidaLogado();
        parent::__construct($data_hora, $mensagem);
        
        $this->_entidade = $entidade;
        $this->_info = $info;

    }


}