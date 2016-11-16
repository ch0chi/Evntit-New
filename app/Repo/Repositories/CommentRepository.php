<?php
/**
 * Created by PhpStorm.
 * User: Michael's Account
 * Date: 5/23/2016
 * Time: 7:29 AM
 */

namespace App\Repo\Repositories;


class CommentRepository extends Repository
{
    public function model(){
        return 'App\Comment';
    }

}