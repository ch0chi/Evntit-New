
@extends('layouts.app')
@section('content')
<?php use Carbon\Carbon;?>
<div id="myEventsWrapper" class="container-fluid">
    <div class="container">
        <div class="row">

            @foreach($events as $index=>$event)


                <div id="" class="col-md-4">
                    <div class="well event">
                        <div class="eventCardImage" style="background-image:url('uploads/Users/{{$event->user_id}}/{{$event->event_image}}')"></div>
                        <div class="eventCardBody">
                            <a href="https://facebook.com/{{$event->facebook_id}}"><img src="{{$event->avatar}}" height="15px" width="15px"><span class="eventCardUserName">{{$event->name}}</span></a>
                            <h2>{{$event->event_name}}</h2>
                            <p><i class="fa fa-clock-o" aria-hidden="true"></i>
                               <?php $date =  date_create($event->event_time);?>
                                {{date_format($date,"D, M d, Y g:iA")}}
                            </p>

                            <span>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{$event->city}}, {{$event->state}}
                            </span>



                        </div>
                        <a href="{{url('/event')}}/{{$event->event_key}}"><button class="btn btn-primary center-block">View</button></a>


                    </div>

                </div>

            @endforeach


        </div>
    </div>
</div>
@endsection