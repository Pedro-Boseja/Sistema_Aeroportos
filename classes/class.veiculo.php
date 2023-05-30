<?php

    include_once ('class.viagem.php');
    include_once('class.apigooglemaps.php');

    $map = new GoogleMapAPI('map');
    // setup database for geocode caching
    $map->setDSN('mysql://USER:PASS@localhost/GEOCODES');
    // enter YOUR Google Map Key
    $map->setAPIKey('AIzaSyA_471Fs_O2mQ0XYyZ2jwhvcPT3g33EDVY');
    
    class Veiculo {

        private int $_capacidade;
        private float $_v_media;
        private float $_t_percurso;
        private float $_d_total;
        private $_viagem = array();
        private $_rota = array();
        
        public function __construct (int $capacidade,
                                     float $v_media,) {
            $this->_capacidade = $capacidade;
            $this->_v_media = $v_media;
            //$this->_rota = $this->CalculaRota($viagem);
            //$this->_d_total = $this->CalculaDTotal();
            //$this->_t_percurso = $this->CalculaTempo();                           
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

        public function setDTotal (float $distancia) {
            $this->_d_total = $distancia;
        }

        public function setRota ($rota) {
            $this->_rota = $rota;
        }

        public function CalculaRota (Viagem $viagem) {
            $rota = array();
            //
            return $rota;
        }

        public function CalculaTempo () {
            $tempo = $this->_d_total / $this->_v_media;
            return $tempo;
        }

        public function CalculaDistancia (string $endereço1, string $endereço2) {
            $distancia = 0;
            //Usar a api do google maps pra pegar as coordenadas dos dois endereços
            //return 110.57 * sqrt( pow($x2-$x1,2) + pow($y2-$y1, 2));
            return $distancia;
        }

        //Calcula as distâncias entre todos os pnts da rota e depois soma elas 
        public function CalculaDTotal () {
            $n_enderecos = count($this->_rota);
            $distancia = 0;
            for ($i = 1; $i <= $n_enderecos; $i++) {
                $distancia += $this->CalculaDistancia(current($this->_rota[$i-1]), current($this->_rota[$i]));
            }
            return $distancia;
        }

        public function CadastraViagem ($viagem) {
            array_push($this->_viagem, $viagem);
        }
    }