<?php
    include_once "../global.php";
    class Usuario extends persist{
        private string $_login;
        private string $_senha;
        private string $_email;
        private bool $logado = 0;
        static $local_filename = "usuarios.txt";

        public function __construct(){

        }
        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        public function Registrar ($login, $senha, $email){
            if($this->Login($login, $senha) == "Usuário não encontrado"){
                $this->_login = $login;
                $this->_senha = $senha;
                $this->_email = $email;
                $this->save();
            }else{
                return "Usuário já cadastrado";
            }
        }
        public function Login ($login, $senha){
            $temp = $this->getRecordsByField("_login", $login);
            if($temp == null){
                return "Usuário não encontrado";
            }
            if($temp[0]->getSenha() == $senha){
                $this->setLogado();
                $this->_login = $temp[0]->getLogin();
                $this->_senha = $temp[0]->getSenha();
                $this->_email = $temp[0]->getEmail();
            }else{
                return "Senha incorreta";
            }
            
        }
        public function Sair(){
            $this->_login = '';
            $this->_senha = '';
            $this->_email = '';
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
            $this->logado = true;
        }
        private function setDeslogado(){
            $this->logado = false;
        }
    }