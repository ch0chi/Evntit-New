<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use DB;
use App\Repo\Repositories\EventRepository as Event;
use App\Libraries\Location;
use App\Libraries\DateTime;
class SearchController extends Controller
{
    
    private $event;
    public function __construct(Event $event){
        $this->event = $event;
    }
    
    public function showEvents(Request $request){
        //validate
        $this->validate($request,[
            'category'   =>  'required',
            'location'   =>  'required'
        ]);

        $location = new Location();

        $city = $location->parse($request->input('location'))['city'];
        $state = $location->parse($request->input('location'))['state'];
        $dates = [];
        $events = $this->event->findMultipleJoin('user_events','users','event_id','user_id',[
            'category'  =>  $request->input('category'),
            'city'      =>  $city,
            'state'     =>  $state
        ]);
        $dateTime = new DateTime();
        $event = $events->toArray();
        foreach($event as $e){
           array_push($dates,date_parse($e['event_time']));
        }

        
        


        return view('events/search',compact('events','dates'));
    }

    /**
     *Fetches ajax call for the cities search bar and dynamically
     * returns the search data
     * 
     * @param Request $request
     */
    public function search(Request $request){
        $location = $request->input('location');
        $result = DB::table('cities')->select('city','state','zip')->where('city','LIKE', "%$location%")->take(20)->get();
        foreach($result as $r){
                echo "<li onclick=\"selectCity('$r->city, $r->state')\">$r->city, $r->state, $r->zip</li>";
        }
    }

}
