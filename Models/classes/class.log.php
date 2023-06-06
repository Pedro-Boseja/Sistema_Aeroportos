<?php

include_once "..global.php";

class Log extends persist{


    protected $_usuario;
    protected $_data_hora;

    static $local_filename = "Logs.txt";

    static public function getFilename(){
        
        return get_called_class()::$local_filename;
    }


}