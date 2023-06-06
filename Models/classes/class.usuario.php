<?php
    include_once "../Models/global.php";
    class Usuario extends persist{
        protected string $_login;
        private string $_senha;
        private string $_email;
        static public ?Usuario $logado = null;
        static $local_filename = "usuarios.txt";


        protected function __construct(string $login, string $senha, string $email){
            $this->_login = $login;
            $this->_senha = $senha;
            $this->_email = $email;
        }
        static public function getFilename() {
            return get_called_class()::$local_filename;
        }
        static public function Registrar ($login, $senha, $email){
            Usuario::ValidaLogado();

            $temp = Usuario::getRecordsByField("_login", $login);
            if($temp == null){
                $user = new Usuario($login, $senha, $email);
                $user->save();
                echo "usuário ".$login." registrado com sucesso";
            }else{
                throw new Exception("Usuário já cadastrado");
            }
        }
        static public function Login ($login, $senha){
            if(Usuario::$logado != null){
                throw new Exception("já existe um usuario logado");
            }
            $temp = Usuario::getRecordsByField("_login", $login);
            if($temp == null){
                throw new Exception("Usuário não encontrado");
            }
            if($temp[0]->getSenha() == $senha){
                // $this->setLogado();
                // $this->_login = $temp[0]->getLogin();
                // $this->_senha = $temp[0]->getSenha();
                // $this->_email = $temp[0]->getEmail();
                Usuario::$logado = $temp[0];
                echo "usuário ".$login." logado com sucesso";
            }else{
                throw new Exception("Senha Incorreta");
            }
            
        }
        static public function Sair(){
            Usuario::ValidaLogado();
            Usuario::$logado = null;
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

        static public function ValidaLogado(){
            if(Usuario::$logado == null){
                throw new Exception("Não há usuario logado");
            }
        }

        // private function setLogado(){
        //     Usuario::$logado = $this;
        // }
        // private function setDeslogado(){
        //     Usuario::$logado = null;
        // }
    }