
@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                @if($events->isEmpty())
                    <div class="col-md-8 col-md-offset-2">
                        <h1>Oops, looks like there aren't any events for this cateogry and location.</h1>
                        <h4>Click <a href="{{URL::to('/')}}">here</a> to try searching for something new.</h4>
                        <h4>Or, try creating your own <a href="{{URL::to('events/add_event')}}">event</a></h4>
                    </div>

                @endif
                @foreach($events as $index =>$event)

                <div id="" class="col-md-4">
                    <div class="well event">
                        <div class="eventCardImage" style="background-image:url('uploads/Users/{{$event->user_id}}/{{$event->event_image}}')"></div>
                        <div class="eventCardBody">
                            <a href="https://facebook.com/{{$event->facebook_id}}"><img src="{{$event->avatar}}" height="15px" width="15px"><span class="eventCardUserName">{{$event->name}}</span></a>
                            <h2>{{$event->event_name}}</h2>
                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$event->event_time->toDayDateTimeString()}}</p>
                            <span>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{$event->city}}, {{$event->state}}
                            </span>



                        </div>
                        <a href="{{URL::to('event')}}/{{$event->event_key}}"><button class="btn btn-primary center-block">View</button></a>


                    </div>

                </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection