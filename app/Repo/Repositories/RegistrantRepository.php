<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/23/2016
 * Time: 6:03 PM
 */

namespace App\Repo\Repositories;


class RegistrantRepository Extends Repository
{

    /**
     * @return string instance of Registrant Model
     */
    public function model(){
        return 'App\Registrant';
    }
}