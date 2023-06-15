<?php

include_once "../global.php";


class Log extends persist{


    protected $_usuario;
    protected $_data_hora;
    protected $_mensagem;

    static $local_filename = "Logs.txt";

    public function __construct(DateTime $data, string $mensagem, Usuario $user = Usuario::$logado){
        Usuario::ValidaLogado();
        $this->_data_hora = $data;
        $this->_usuario = $user;
        $this->_mensagem = "User: ". $user->getLogin().". " . $mensagem;
    }

    static public function getFilename(){
        
        return get_called_class()::$local_filename;
    }

    public function getMessage(){
        return $this->_mensagem;
    }

    static public function ImprimirLogs(){
        
    }
    


}