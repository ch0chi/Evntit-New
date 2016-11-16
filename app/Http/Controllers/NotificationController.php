<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\Repositories\UserEventRepository as UserEvent;
use App\Repo\Repositories\UserRepository as User;
use App\Http\Requests;

class NotificationController extends Controller
{
    private $userEvent,$user;
    public function __construct(User $user, UserEvent $userEvent){
        $this->middleware('auth');
        $this->user = $user;
        $this->userEvent = $userEvent;
    }
}
