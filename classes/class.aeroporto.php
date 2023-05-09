<?php
include_once("persist.php");

  class Aeroporto extends persist{
    protected string $_sigla;
    protected string $_cidade;
    protected string $_estado;
    static $local_filename = "aeroportos.txt";

    public function __construct (string $sigla, string $cidade, string $estado){
      $this -> _sigla = $sigla;
      $this -> _cidade = $cidade;
      $this -> _estado = $estado;
      $this->save();
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