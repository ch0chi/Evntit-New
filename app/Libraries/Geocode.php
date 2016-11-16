<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/23/2016
 * Time: 4:57 AM
 */

namespace App\Libraries;


class Geocode
{
    private $_lat,$_long;

    public function __construct(){
    }

    /**
     * @param $city
     * @param $state
     *
     * Takes in the events city and the events state then calls the google geocode api to
     * reverse geocode the desired location
     *
     * @return array $coords
     */
    public function geocodeAddress($city,$state){
        $cleanCity = str_replace(' ','',$city);
        $cleanState = str_replace(' ','',$state);
        $url="http://maps.googleapis.com/maps/api/geocode/json?address=$cleanCity+$cleanState&sensor=false";

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "\n<br />";
            $contents = '';
        } else {
            curl_close($ch);
        }

        if (!is_string($contents) || !strlen($contents)) {
            echo "Failed to get contents.";
            $contents = '';
        }
        
        $obj = json_decode($contents);
        $lat = $obj->results[0]->geometry->location->lat;
        $long = $obj->results[0]->geometry->location->lng;
        $coords = ['lat'=>$lat,'long'=>$long];
        return $coords;

    }
    
    public function setLat($latitude){
        $this->_lat=$latitude;
    }
    public function setLong($longitude){
        $this->_long=$longitude;
    }

    public function fetchLat(){
        return $this->_lat;
    }
    public function fetchLong(){
        return $this->_long;
    }
}