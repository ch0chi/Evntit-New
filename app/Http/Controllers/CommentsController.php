<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Repo\Repositories\EventRepository as Event;
use App\Repo\Repositories\CommentRepository as Comment;

class CommentsController extends Controller
{
    private $event,$comment;
    public function __construct(Event $event, Comment $comment){
        $this->middleware('auth');
        $this->event    = $event;
        $this->comment  = $comment;
    }

    public function submit(Request $request){

        $eventID = \Crypt::decrypt($request->input('event_id'));
        $body = $request->input('body');
        $this->event->comment($body,Auth::user()->id,$eventID);

            
    }
}
