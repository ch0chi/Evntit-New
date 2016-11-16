<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/17/16
 * Time: 4:41 AM
 */

namespace App\Repo\Repositories;


class NotificationRepository extends Repository
{
    /**
     * Defines model to be used in the Repository
     *
     * @return string
     */
    function model(){
        return 'App\UserNotification';
    }
}