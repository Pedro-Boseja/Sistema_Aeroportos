<?php

include_once "../Models/global.php";

class Aeronave extends persist{
  
  private string $_fabricante;
  private string $_modelo;
  private string $_registro;
  private int $_capacidade_p;
  private float $_capacidade_c;
  static $local_filename = "aeronaves.txt";
  private $_assentos = array();
  private $_viagens_planejadas = array();

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
    verifica_ModeloAeronave($registro);
    $this->_registro = $registro;
    $this->_capacidade_p = $capacidade_p;
    $this->_capacidade_c = $capacidade_c;
    $this->_assentos = $this->MontarAssentos($largura, $comprimento);
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_escrita(new DateTime(), "Aeronave", "null", serialize($this));
    $log->save();
  }
  static public function getFilename() {
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, "Aeronave", "filename");
    $log->save();
    return get_called_class()::$local_filename;
}
  public function getFabricante(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "fabricante");
    $log->save();
    return $this->_fabricante;
  }

  public function getModelo(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "modelo");
    $log->save();
    return $this->_modelo;
  }

  public function getRegistro(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "registro");
    $log->save();
    return $this->_registro;
  }

  public function getCapacidadeP(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "capacidade passageiros");
    $log->save();
    return $this->_capacidade_p;
  }

  public function getCapacidadeC(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "capacidade carga");
    $log->save();
    return $this->_capacidade_c;
  }

  public function getAssentos(){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "Assentos");
    $log->save();
    return $this->_assentos;
  }

  public function MontarAssentos (int $largura, int $comprimento){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "Construiu assentos");
    $log->save();
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

  public function isAvaliable(Viagem $viagem){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    $log = new Log_leitura(new DateTime, serialize($this), "disponibilidade");
    $log->save();
    if(count($this->_viagens_planejadas) == 0){

      return true;
    }

    foreach($this->_viagens_planejadas as $viplan){
      
      if($viagem->IsIn($viplan)){

        return false;

      }
      
    }

    return true;

  }

  public function addViagem(Viagem $viagem){
    if(Usuario::$logado == null){
      throw new Exception("não há usuário logado");
    }
    
    $obj_antes = serialize($this);
    array_push($this->_viagens_planejadas, $viagem);
    $obj_depois = serialize($this);
    $log = new Log_escrita(new DateTime(), "aeronave", $obj_antes, $obj_depois);
    $log->save();

  }

  public function getViagens(){

    $viagens = array();

    foreach($this->_viagens_planejadas as $viagem){
      
    }
  }
}