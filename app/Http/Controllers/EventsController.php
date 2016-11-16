<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repo\Repositories\EventRepository as Event;
use App\Repo\Repositories\CategoryRepository as Category;
use App\Repo\Repositories\UserEventRepository as UserEvent;
use App\Repo\Repositories\UserRepository as User;
use App\Repo\Repositories\RegistrantRepository as Registrant;
use App\Repo\Repositories\NotificationRepository as Notification;
use App\Libraries\Upload;
use App\Libraries\Location;
use App\Libraries\Geocode;
use App\Libraries\DateTime;
use Carbon\Carbon;
use Hashids\Hashids;
use Auth;

/**
 * Class EventsController
 *
 * Handles all REST requests and event methods
 *
 * @package App\Http\Controllers
 */
class EventsController extends Controller
{

    private $event;
    private $category;
    private $registrant;
    private $notification;
    private $userEvent;
    private $hashID;
    private $user;


    /**
     * Constructor Injection
     *
     * EventsController constructor.
     * @param Event $event
     * @param Category $category
     * @param UserEvent $userEvent
     * @param User $user
     * @param Registrant $registrant
     * @param Notification $notification
     */
    public function __construct(Event $event,Category $category, UserEvent $userEvent, User $user, Registrant $registrant, Notification $notification)
    {
        $this->middleware('auth');
        $this->event     = $event;
        $this->category  = $category;
        $this->userEvent = $userEvent;
        $this->hashID = new Hashids();
        $this->user = $user;
        $this->registrant = $registrant;
        $this->notification = $notification;
    }


    /**
     * Returns event dashboard page
     * 
     * @return mixed
     */
    public function eventDashboard()
    {
        return view('events/event_dashboard');
    }

    /**
     * Returns the add event page
     * 
     * @return mixed
     */
    public function showForm(){

        $categories = $this->category->all();
        return view('events/add_event',compact('categories'));
    }

    /**
     * Fetches add event form data, validates, and calls the 
     * repository to insert the data into the database
     * 
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        //Validate data
        $this->validate($request, [
            'event_image'       =>      'required|image|mimes:jpeg,jpg,bmp,png,gif|max:10000',
            'event_name'        =>      'required|max:100',
            'category'          =>      'required',
            'description'       =>      'required',
            'location'          =>      'required',
            'date'              =>      'required',
            'time'              =>      'required'
        ]);


        $location = new Location();
        $event_image = new Upload();
        

        $event = $this->event->create([
            'event_name'        =>      $request->input('event_name'),
            'description'       =>      $request->input('description'),
            'category'          =>      $request->input('category'),
            'event_image'       =>      $event_image->uploadImage($request->file('event_image'),Auth::user()->id),
            'city'              =>      $location->parse($request->input('location'))['city'],
            'state'             =>      $location->parse($request->input('location'))['state'],
            'event_time'        =>      $request->input('prefix__date__suffix')." ".$request->input('prefix__time__suffix'),
            'user_id'           =>      \Auth::user()->id
        ]);
        $key = $this->hashID->encode($event->id,Auth::user()->id);
        $this->event->update($event->id, array('event_key' => $key));
        $this->userEvent->create([
            'event_id'          =>      $event->id,
            'user_id'           =>      \Auth::user()->id
        ]);

        return \Redirect::to('/');
    }


    /**
     * Displays event based on uniquely generated URI
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $geocode = new Geocode();
        $eventDetails = $this->hashID->decode($id);
        $event_id = $eventDetails[0];
        $user_id= $eventDetails[1];


        $users = $this->user->showEvent($user_id,$event_id);

        $coords = [];
        foreach($users as $userEvent){
            foreach($userEvent->event as $event){
                array_push($coords, $geocode->geocodeAddress($event->city,$event->state));
            }
        }
        
        return view('/events/event',compact('users','coords'));
    }


    /**
     * Still in production- updates a comment on a users event
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $eventID = \Crypt::decrypt($request->input('event_id'));
        $body = $request->input('body');
        $this->event->comment($body,Auth::user()->id,$eventID);
        return back();
    }


    /**
     * Handles event registration
     *
     * @param Request $request
     */
    public function signup(Request $request){

        $eventDetails = $this->hashID->decode($request->input('eventKey'));
        $event_id = $eventDetails[0];
        $user_id_to= $eventDetails[1];


        $this->validate($request,[
            'user_id'  => 'unique_with:registrants,event_id'
        ]);

        $user_id_from= $request->input('user_id');

        $this->registrant->create([
           'event_id' => $event_id,
            'user_id' => $user_id_from
        ]);

        $this->notification->create([
            'user_id_to'    =>  $user_id_to,
            'user_id_from'  =>  $user_id_from,
            'event_id'      =>  $event_id
        ]);
    }


    /**
     * Displays all events created by the associated user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userEvents(){
        $userID = \Auth::user()->id;
        $dates = [];
        $events = $this->userEvent->findJoin('user_events','events','users','event_id','id','user_id','id',[
            'user_events.user_id'   =>  $userID
        ]);
        $event = $events->toArray();
        foreach($event as $e){
            array_push($dates,date_parse($e['event_time']));
        }

        return view('my_events',compact('events','dates'));
    }

}