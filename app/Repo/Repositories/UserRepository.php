<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/23/2016
 * Time: 10:04 AM
 */

namespace App\Repo\Repositories;


class UserRepository extends Repository
{
    /**
     * Defines model to be used in the Repository
     *
     * @return string
     */
    function model(){
        return 'App\User';
    }


}