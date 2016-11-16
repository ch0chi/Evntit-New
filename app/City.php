<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    private $_city,$_state;

    /**
     * @param string $location  The location inputted by the users
     * @var array $parsedLoc splits $location
     * @var string $clean calls upon the escape method to clean the string from foreign characters.
     * @var string $trimmed
     */
    public function parseSearchLocation($location){
        
        $parsedLoc = explode(",", $location);
        $trimmed = trim($parsedLoc[1], " ");
        $zipTrimmed = trim($parsedLoc[2]," ");
        $this->_city = $parsedLoc[0];
    }

    /**
     * @return mixed returns the city
     */
    public function fetchCity(){
        return $this->_city;
    }

    /**
     * @return mixed returns the state
     */
    public function fetchState(){
        return $this->_state;
    }
 
}
