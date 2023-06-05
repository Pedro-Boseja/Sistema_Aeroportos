<?php
    include_once "../Models/global.php";
    class Usuario extends persist{
        protected string $_login;
        private string $_senha;
        private string $_email;
        static public ?Usuario $logado = null;
        static $local_filename = "usuarios.txt";


        public function __construct(){
            if(Usuario::$logado != null){
                throw new Exception("Já há usuário logado, é permitido apenas um por vez.");
            }
        }
        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        public function Registrar ($login, $senha, $email){
            if(Usuario::$logado == null){
                throw new Exception("não há usuário logado");
            }
            
            
            $temp = $this->getRecordsByField("_login", $login);
            if($temp == null){
                $this->_login = $login;
                $this->_senha = $senha;
                $this->_email = $email;
                $this->save();
            }else{
                throw new Exception("Usuário já cadastrado");
            }

            $this->save();
        }
        public function Login ($login, $senha){
            if(Usuario::$logado != null){
                throw new Exception("já existe um usuario logado");
            }
            $temp = $this->getRecordsByField("_login", $login);
            if($temp == null){
                throw new Exception("Usuário não encontrado");
            }
            if($temp[0]->getSenha() == $senha){
                $this->setLogado();
                $this->_login = $temp[0]->getLogin();
                $this->_senha = $temp[0]->getSenha();
                $this->_email = $temp[0]->getEmail();
            }else{
                throw new Exception("Senha Incorreta");
            }
            
        }
        public function Sair(){
            // $this->_login = '';
            // $this->_senha = '';
            // $this->_email = '';
            $this->setDeslogado();
        }
        public function getEmail(){
            return $this->_email;
        }
        public function getSenha(){
            return $this->_senha;
        }
        public function getLogin(){
            return $this->_login;
        }
        private function setLogado(){
            Usuario::$logado = $this;
        }
        private function setDeslogado(){
            Usuario::$logado = null;
        }
    }