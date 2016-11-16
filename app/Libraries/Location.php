<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/17/2016
 * Time: 5:49 PM
 */

namespace App\Libraries;


class Location
{
    
    public function __constructor(){
        
    }
    /**
     * Split location array
     *
     * @param $location
     * @return array
     */
    public function parse($location){
        $parsedLoc = explode(",", $location);
        $trimmed = trim($parsedLoc[1], " ");
        $city = $parsedLoc[0];
        $state = $trimmed;
        return array('city'=>$city,'state'=>$state);
    }
}