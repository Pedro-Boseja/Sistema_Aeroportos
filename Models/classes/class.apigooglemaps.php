<?php

class apigooglemaps {

    private $api_key = '';
    private $lookup_service = 'GOOGLE';
	  private $lookup_server = array('GOOGLE' => 'maps.google.com', 'YAHOO' => 'api.local.yahoo.com');
        
    public function __construct($key){
      $this->setAPIKey($key);
    }
  
      private $_api_key = '';
      private $_lookup_service = 'GOOGLE';
  	  private $_lookup_server = array('GOOGLE' => 'maps.google.com', 'YAHOO' => 'api.local.yahoo.com');
          
    
      //sets YOUR Google Map API key
      public function setAPIKey($key) {
          $this->_api_key = $key;   
      }
  
      //set the lookup service to use for geocode lookups
      //default is GOOGLE.
      public function setLookupService($service) {
          switch($service) {
              case 'GOOGLE':
                  $this->_lookup_service = 'GOOGLE';
                  break;
          }       
      }
   
      //get geocode lat/lon points for given address from google
      public function geoGetCoords($address,$depth=0) {      
        $url = sprintf('https://%s/maps/api/geocode/json?&address=%s&output=csv&key=%s',$this->_lookup_server['GOOGLE'],rawurlencode($address),$this->_api_key);
        //echo $url . "\n";
  
        $result = false;
                  
          if($result = $this->fetchURL($url)) {
            $result_parts = explode(':',$result);

        
            $coords['lat'] = floatval($result_parts[27]);
            $coords['lng'] = floatval($result_parts[28]);
          }
          return $coords;       
      }
      
      //fetch a URL. Override this method to change the way URLs are fetched.
      public function fetchURL($url) {
          return file_get_contents($url);
      }
  
      //get distance between to geocoords using great circle distance 
      public function geoGetDistance($origens, $destinos) {

        $url = sprintf('https://%s/maps/api/distancematrix/json?origins=%s&destinations=%s&mode=driving&language=pt-BR&sensor=false&key=%s', $this->_lookup_server['GOOGLE'], rawurlencode($origens[0]), rawurlencode($destinos[0]), $this->_api_key);
        
        $result = false;
                  
          if($result = $this->fetchURL($url)) {
            $result_parts = explode(':',$result);
        
            $matrix['distance'] = intval($result_parts[7]);
            echo $matrix['distance'] . "\n";
            $matrix['duration'] = intval($result_parts[10]);
            echo $matrix['duration'] . "\n";
          }
        
          return $matrix;      
      }    
  }