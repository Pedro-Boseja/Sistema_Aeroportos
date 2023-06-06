<?php

include_once "../Models/global.php";

class Tripulante extends persist{

    protected Cadastro $_cadastro;
    private Aeroporto $_aeroporto_base;
    private CompanhiaAerea $_companhia;
    private $_viagens_planejadas = array();
    static $local_filename = "tripulantes.txt";

    public function __construct(Cadastro $cadastro, $data_nascimento, $nacionalidade, $email, string $documento, string $endereco, CompanhiaAerea $companhia, Aeroporto $aeroporto, $numero_cpf = "VAZIO"){
        Usuario::ValidaLogado();
        $this->_cadastro = $cadastro;
        $this->_cadastro->fillTripulante($data_nascimento, $nacionalidade, $numero_cpf, $email, $documento, $endereco);
        $this->_companhia = $companhia;
        $this->_aeroporto_base = $aeroporto;
    }
    
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }

    public function getCadastro(){
        return $this->_cadastro;
    }

    public function getAeroporto(){
        return $this->_aeroporto_base;
    }

    public function getCompanhia(){
        return $this->_companhia;
    }

    public function setAeroporto(Aeroporto $aeroporto){
        $this -> _aeroporto_base = $aeroporto;
    }

    public function setCompanhia(CompanhiaAerea $companhia){
        $this -> _companhia = $companhia;
    }

    public function addViagem(Viagem $viagem){
        if(Usuario::$logado == null){
          throw new Exception("não há usuário logado");
        }
        
        $obj_antes = serialize($this);
        array_push($this->_viagens_planejadas, $viagem);
        $obj_depois = serialize($this);
        $log = new Log_escrita(new DateTime(), "tripulante", $obj_antes, $obj_depois);
        $log->save();
    
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
}