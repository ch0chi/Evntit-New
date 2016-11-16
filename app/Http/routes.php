<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@index');

Route::auth();


//Rest resource for events controller
Route::resource('event','EventsController');

Route::post('search','SearchController@showEvents');

//submit comment
Route::post('comment/submit_comment','CommentsController@submit');

//signup
Route::post('event/signup/','EventsController@signUp');







Route::get('/home', 'HomeController@index');

//handle facebook authentication
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

//display event dashboard
Route::get('events/event_dashboard',function(){
    if(Auth::check()){
        return view('events/event_dashboard');
    }else{
        abort(404);
    }
});

//display add_event page
Route::get('events/add_event','EventsController@showForm');


//search location
Route::post('/{events?}/search_location','SearchController@search');


//testing pusher
//pusher(key, secret,appid)
Route::any('test',function(){

   $pusher =  new Pusher(env('PUSHER_PUBLIC'),env('PUSHER_SECRET'),env('PUSHER_APP_ID'),array(
        'cluster'=> 'ap1'
   ));

    $pusher->trigger('demoChannel','userLikedPost',[]);

    return 'Done';
});
Route::get('my_events','EventsController@userEvents');
