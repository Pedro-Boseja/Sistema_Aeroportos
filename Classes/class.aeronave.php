<?php

class Aeronave {
  
  private string $_fabricante;
  private string $_modelo;
  private string $_registro;
  private int $_capacidade_p;
  private float $_capacidade_c;
  private $_assentos = array();

  public function __construct(
                            string $fabricante,
                            string $modelo, 
                            string $registro,
                            int $capacidade_p,
                            float $capacidade_c,
                            int $largura,
                            int $comprimento,)       
  {
    $this->_fabricante = $fabricante;
    $this->_modelo = $modelo;
    $this->_registro = $registro;
    $this->_capacidade_p = $capacidade_p;
    $this->_capacidade_c = $capacidade_c;
    $this->_assentos = $this->MontarAssentos($largura, $comprimento);      
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

  public function getAssentos(){
    return $this->_assentos;
  }

  public function MontarAssentos (int $largura, int $comprimento){
    $assentos = array();
    for($i = 1; $i <= $comprimento; $i++) {
      $l = 65;
      for ($j = 0; $j < $largura; $j++) {
        $str = chr($l);
        array_push($assentos, "$i$str");
        $l += 1;
      }
    }
    $a = array_fill_keys($assentos, "vazio");
    return $a;
  }
}
