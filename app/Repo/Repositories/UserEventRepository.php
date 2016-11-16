<?php

namespace App\Repo\Repositories;


class UserEventRepository extends Repository
{
    /**
     * Defines model to be used in the Repository
     *
     * @return string
     */
    function model(){
        return 'App\UserEvent';
    }


}