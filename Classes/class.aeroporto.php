<?php

  class Aeroporto{
    protected string $_sigla;
    protected string $_cidade;
    protected string $_estado;

    public function __construct (string $sigla, string $cidade, string $estado){
      $this -> _sigla = $sigla;
      $this -> _cidade = $cidade;
      $this -> _estado = $estado;
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
