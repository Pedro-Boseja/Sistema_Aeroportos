<?php

class apigooglemaps {

    private $api_key = '';
    private $lookup_service = 'GOOGLE';
	  private $lookup_server = array('GOOGLE' => 'maps.google.com', 'YAHOO' => 'api.local.yahoo.com');
        
    public function __construct($key){
      Usuario::ValidaLogado();
      $this->setAPIKey($key);
    }
  
    //sets YOUR Google Map API key
    public function setAPIKey($key) {
        $this->api_key = $key;   
    }

    //set the lookup service to use for geocode lookups
    //default is GOOGLE.
    public function setLookupService($service) {
        switch($service) {
            case 'GOOGLE':
                $this->lookup_service = 'GOOGLE';
                break;
        }       
    }
 
    //get geocode lat/lon points for given address from google
    public function geoGetCoords($address,$depth=0) {      
                $_url = sprintf('https://%s/maps/api/geocode/json?&address=%s&output=csv&key=%s',$this->lookup_server['GOOGLE'],rawurlencode($address),$this->api_key);

                $_result = false;
                
                if($_result = $this->fetchURL($_url)) {

                    $_result_parts = explode(':',$_result);
      
                    $_coords['lat'] = floatval($_result_parts[27]);
                    $_coords['lng'] = floatval($_result_parts[28]);
                }
        return $_coords;       
    }
    
    //fetch a URL. Override this method to change the way URLs are fetched.
    public function fetchURL($url) {
        return file_get_contents($url);
    }

    //get distance between to geocoords using great circle distance 
    public function geoGetDistance($lat1,$lng1,$lat2,$lng2,$unit='K') {
        
      // calculate kilometers
      //$M =  69.09 * rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2)))); 
      $M = 110.57 * sqrt( pow($lat2-$lat1,2) + pow($lng2-$lng1, 2));
      

      switch(strtoupper($unit))
      {
        case 'K':
          // kilometers
          return $M * 1.609344; 
          //break;/
        case 'N':
          // nautical miles
          return $M * 0.868976242;
          //break;
        case 'F':
          // feet
          return $M * 5280;
          //break;            
        case 'I':
          // inches
          return $M * 63360;
          //break;            
        case 'M':
        default:
          // miles
          return $M;
          //break;
      }
    }    
}
