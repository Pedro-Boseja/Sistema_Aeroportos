<?php

include_once "../global.php";


class Log extends persist{


    protected Usuario $_usuario;
    protected $_data_hora;
    protected $_mensagem;

    static $local_filename = "Logs.txt";

    public function __construct(DateTime $data, string $mensagem){
        Usuario::ValidaLogado();
        $this->_data_hora = $data;
        $this->_usuario = Usuario::getLogado();
        $this->_mensagem = "User: ". $this->_usuario->getLogin().", em " .$data->format("d/m/Y H:i:s"). " => ".$mensagem;
    }

    static public function getFilename(){
        
        return get_called_class()::$local_filename;
    }

    public function getMessage(){
        return $this->_mensagem;
    }

    static public function ImprimirLogs(){
        $logs = Log::getRecords();

        echo"\nREGISTRO DE LOGS: \n";
        foreach($logs as $l){
            echo $l->getMessage()."\n";
        }
        echo"FIM DO REGISTRO\n";
    }
    


}