<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/20/2016
 * Time: 1:49 AM
 */

namespace App\Repo\Repositories;


class CategoryRepository extends Repository
{
    /**
     * Defines model to be used in the Repository
     *
     * @return string
     */
    function model(){
        return 'App\Category';
    }


}