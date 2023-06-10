<?php

include_once "../global.php";

  
  ini_set('allow_url_fopen', true);
  ini_set('allow_url_include', true);

    class Veiculo extends persist{

        private int $_capacidade;
        private float $_v_media;
        private float $_t_percurso;
        private float $_d_total;
        private Viagem $_viagem;
        private $_rota = array();
        private $_viagens_planejadas = array();
        private $_horarios_embarque = array(); //relaciona o tripulante com o horario de embarque
        private apigooglemaps $_map;
        static $local_filename = "veiculos.txt";
        
        public function __construct (int $capacidade,
                                     float $v_media,
                                     $viagem) {
            Usuario::ValidaLogado();
            $this->_capacidade = $capacidade;
            $this->_v_media = $v_media;
            $this->_map = new apigooglemaps('AIzaSyA_471Fs_O2mQ0XYyZ2jwhvcPT3g33EDVY');
            $this->_rota = $this->CalculaRota($viagem);
            $this->_d_total = $this->CalculaDTotal();
            $this->_t_percurso = $this->CalculaTempo();                           
        }

        static public function getFilename() {
            return get_called_class()::$local_filename;
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
            $tripulantes = $viagem->getTripulantes();
            $endereços = array();
            foreach ($tripulantes as $t){
              array_push($endereços, $t->getCadastro()->getEndereco());
            }

            $aeroporto_saida = $viagem->getAeroportoSaida();
          
            $endereco_aeroporto = sprintf('%s, %s, %s', $aeroporto_saida->getSigla(), $aeroporto_saida->getCidade(), $aeroporto_saida->getEstado());
          
            $distancias = array();

            foreach ($endereços as $r) {
              $distancias[$r] = $this->CalculaDistancia($endereco_aeroporto, $r);
            }

            $rota = $endereco_aeroporto;
            $a = sort($distancias);
            $rota += array_keys($distancias);
            array_push($rota, $endereco_aeroporto);
    
            return $rota;
        }

        public function CalculaTempo () {
            $tempo = ($this->_d_total / $this->_v_media)*3600;
            return $tempo;
        }

        public function CalculaHorariosEmbarque () {
          $horarios = array();

          $n_enderecos = count($this->_rota);
          $distancias = array();
          for ($i = 1; $i <= $n_enderecos; $i++) {
            array_push ($distancias, $this->CalculaDistancia(current($this->_rota[$i-1]), current($this->_rota[$i])));
          }

          $distancias = array_reverse($distancias);

          $horario_chegada = $this->_viagem->getDataS()->getTimestamp() - 5400;

          $n_distancias = count($distancias);
          $horarios = array();
          for ($i = 0; $i <= $n_distancias; $i++) {
            array_push ($horarios, (($horario_chegada-(current($distancias[$i])/$this->_v_media))*3600));
          }
    
          return $horarios;
        } 

        public function CalculaDistancia (string $endereço1, string $endereço2) {
            //Usar a api do google maps pra pegar as coordenadas dos dois endereços
            $lat1 = $this->_map->geoGetCoords($endereço1)['lat'];
            $lon1 = $this->_map->geoGetCoords($endereço1)['lng'];
            $lat2 = $this->_map->geoGetCoords($endereço2)['lat'];
            $lon2 = $this->_map->geoGetCoords($endereço2)['lng'];

            $distancia = 110.57 * sqrt(pow($lat2-$lat1, 2)+pow($lon2-$lon1, 2));
            return $distancia;
  
            
            //// Método alternativo para calcular distâcia usando a matrix de distância do api
            // $a = array($endereço1);
            // $b = array($endereço2);

            // $distancia = $this->_map->geoGetDistance($a, $b);
            // return $distancia['distance'];
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
            $this->_viagem = $viagem;
        }

        public function addViagem (Viagem $viagem){
            array_push($this->_viagens_planejadas, $viagem);
        }

        public function isAvaliable (Viagem $viagem){
    
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