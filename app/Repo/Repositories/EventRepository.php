<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/18/2016
 * Time: 6:01 PM
 */

namespace App\Repo\Repositories;


class EventRepository extends Repository
{
    /**
     * Defines model to be used in the Repository
     *
     * @return string
     */
    function model(){
        return 'App\Event';
    }


}