<?php

include_once "../global.php";


  class Aeroporto extends persist{
    protected string $_sigla;
    protected string $_cidade;
    protected string $_estado;
    static $local_filename = "aeroportos.txt";

    public function __construct (string $sigla, string $cidade, string $estado){
      Usuario::ValidaLogado();
      $this -> _sigla = $sigla;
      $this -> _cidade = $cidade;
      $this -> _estado = $estado;
      $log = new Log_escrita(new DateTime(), "Aeroporto", "null", serialize($this));
      $log->save();
    }
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }
    public function getSigla(){
      return $this -> _sigla;
    }
    public function getCidade(){
      return $this -> _cidade;
    }
    public function getEstado(){
      return $this -> _estado;
    }
    public function setSigla(string $sigla){
      $this -> _sigla = $sigla;
    }
    public function setCidade(string $cidade){
      $this -> _cidade = $cidade;
    }
    public function setEstado(string $estado){
      $this -> _estado = $estado;
    }
  }