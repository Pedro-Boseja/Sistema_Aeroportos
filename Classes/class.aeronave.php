<?php

class Aeronave {
  
  private string $_fabricante;
  private string $_modelo;
  private string $_registro;
  private int $_capacidade_p;
  private float $_capacidade_c;


  public function __construct(
                            string $fabricante,
                            string $modelo, 
                            string $registro,
                            int $capacidade_p,
                            float $capacidade_c)       
  {
    $this->_fabricante = $fabricante;
    $this->_modelo = $modelo;
    $this->_registro = $registro;
    $this->_capacidade_p = $capacidade_p;
    $this->_capacidade_c = $capacidade_c;
      
  }

  public function getFabricante(){
    return $this->_fabricante;
  }

  public function getModelo(){
    return $this->_modelo;
  }

  public function getRegistro(){
    return $this->_registro;
  }

  public function getCapacidadeP(){
    return $this->_capacidade_p;
  }

  public function getCapacidadeC(){
    return $this->_capacidade_c;
  }
  
}
