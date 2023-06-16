<?php

include_once "../global.php";


class ProgramaDeMilhagem{
    private $_categorias=array();
    private $_passageirosvip=array(); //array(Passageiro, categoria(string))
    public function __construct(){
        Usuario::ValidaLogado();
        // $this->_categorias[0]="Sem Categoria";
        // $log = new Log_escrita(new DateTime(), "Programa de MIlhagem", "null", serialize($this), "Companhia criou um programa de milhagem");
        // $log->save();
    } 
    //Pesquisa 
    private function localizaChave(Vip $passageiro){
      $chave = -1;
      foreach ($this->_passageirosvip as $key => $value) {
          if($value[0] == $passageiro){
              $chave = $key;
              break;
          }
      }
      if($chave == -1){
          throw new Exception("Passageiro não encontrado.");
      }
      return $chave;
    }
    public function Upgrade (Vip $passageiro){
    //Realiza a recontagem de pontos de um passageiro e determina sua nova Categoria
        $chave = $this->localizaChave($passageiro);
        $this->_passageirosvip[$chave][1] = $this->getCategoria($passageiro->verificaPontos());
        $this->Downgrade(); //Atualização deve ser diária, mas nesse caso já serve
    }
    public function Downgrade(){
    //Realiza a atualização dos pontos de todos funcionários. (Deve ser execultada diariamente)
        $this->_passageirosvip;
        foreach ($this->_passageirosvip as $key => $value) {
            if($value[1] != $this->getCategoria($value[0]->verificaPontos())){
                $this->_passageirosvip[$key][1] =  $this->getCategoria($value[0]->verificaPontos());
            }
        }
    }
    public function getCategoria(int $pontos){
        //Encontra a classe abaixo da pontuação, para os pontos como chave.
        $c=0; //categoria (valor)
        $p=0; //pontuação (chave)
        foreach ($this->_categorias as $chave => $valor) {
            if($chave<=$pontos && $chave<=$p){
                $c = $chave;
                $p = $valor;
            }
        }
        return $this->_categorias[$c];
    }
    public function setCategoria(string $nome, int $pontos){
        $this->_categorias[$pontos]=$nome;
    }
    public function excluirCategoria($parametro){
        if(is_integer($parametro)){
            //Para parâmetro numérico;
            unset($this->_categorias[$parametro]);
        }elseif(is_string($parametro)){
            //Para parâmentro String;
            foreach ($this->_categorias as $chave => $valor) {
                if($valor == $parametro){
                    unset($this->_categorias[$chave]);
                }
            }
        }else{
            //Exceção para parâmetros inválidos;
            throw new Exception ("Parâmetro passado é inválido.");
        }

    }
    public function setPassageiro(Vip $passageiro){
        array_push($this->_passageirosvip, array($passageiro,$this->getCategoria($passageiro->verificaPontos())));
      //$this->_passageirosvip = $this->getCategoria($passageiro->verificaPontos());
    }
    public function getPassageiros(){
        return array_keys($this->_passageirosvip);
    }
    public function imprimeCategoria(int $pts){
        return $this->getCategoria($pts);
    }
    public function getCategoriaPassageiro(Vip $passageiro){
        return $this->_passageirosvip[$this->localizaChave($passageiro)][1];
    }
}