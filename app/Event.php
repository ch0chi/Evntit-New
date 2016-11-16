<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name','event_key','event_image','description','category','event_time','city','state','user_id'
    ];
    protected $dates = ['event_time'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->hasOne(Category::class);
    }

    public function registrant(){
        return $this->hasMany(Registrant::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function userevents(){
        return $this->hasOne(UserEvent::class);
    }

    public function addComment($body,$userID,$eventID){
        $comment = new Comment();
        $comment->body=$body;
        $comment->user_id=$userID;
        $comment->event_id=$eventID;
        $comment->save();
    }
}
