<?php

    class Veiculo {

        private int $_capacidade;
        private float $_v_media;
        private float $_t_percurso;
        private float $_d_total;
        private $_rota = array();
        
        public function __construct (int $capacidade,
                                     float $v_media,) {
            $this->_capacidade = $capacidade;
            $this->_v_media = $v_media;
            $this->_t_percurso = 0.0;  
            $this->_d_total = 0.0;                          
        }

        public function getCapacidade () {
            return $this->_capacidade;
        }

        public function getVMedia () {
            return $this->_v_media;
        }

        public function getTPercurso () {
            return $this->_t_percurso;
        }

        public function getDTotal () {
            return $this->_d_total;
        }

        public function getRota () {
            return $this->_rota;
        }

        public function setCapacidade (int $capacidade) {
            $this->_capacidade = $capacidade;
        }

        public function setVMedia (float $v_media) {
            $this->_v_media = $v_media;
        }

        public function setTPercurso (float $t_percurso) {
            $this->_t_percurso = $t_percurso;
        }

        //Calcula a distância do primeiro endereço da rota até o último
        public function setDTotal () {
           
        }

        public function setRota ($rota) {
            $this->_rota = $rota;
        }

        public function CalculaRota () {

        }

        public function CalculaTempo () {

        }

        public function CalculaDistancia (float $lt1, float $lg1, float $lt2, float $lgn2) {
            return 110.57 * sqrt( pow($lt2-$lt1,2) + pow($lgn2-$lg1, 2));
        }
    }