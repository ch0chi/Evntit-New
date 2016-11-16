@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="row">
            @foreach($users as $user)
                @foreach($coords as $coord)
                    <div id="lat">{{$coord['lat']}}</div>
                    <div id="long">{{$coord['long']}}</div>
                @endforeach
                @foreach($user->event as $event)


                        <div class="eventImage row well" style="background-image:url('../uploads/Users/{{$user->id}}/banner_{{$event->event_image}}')">
                            <div class="eventHeader">
                                <h1>{{$event->event_name}}</h1>
                            </div>
                        </div>

                    <div id="eventAction" class="well row">
                        <div id="eventInfo">

                            <div class="eventHeader row">
                                <div class="col-xs-12">
                                    <h4><a href="https://facebook.com/{{$user->facebook_id}}"><img src="{{$user->avatar}}" height="15px" width="15px"><span class="eventCardUserName"> {{$user->name}}</span></a></h4>
                                    <h4><i class="fa fa-clock-o" aria-hidden="true"></i> {{$event->event_time->toDayDateTimeString()}}</h4>
                                    <h4><i class="fa fa-map-marker" aria-hidden="true"></i> {{$event->city}}, {{$event->state}}</h4>
                                    @foreach($event->registrant as $registrant)
                                        <h4> <i class="fa fa-users" aria-hidden="true"> {{count($registrant->user_id)}}</i></h4>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div id="eventToolBar">

                            <div class="col-xs-2 col-sm-1" data-toggle="modal" data-target="#messageModal">
                                <div class="eventActionContents">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="col-xs-2 col-sm-1">
                                <div class="eventActionContents">
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="col-xs-2 col-sm-1">
                                <div class="eventActionContents">
                                    <i id="mapToggle" class="fa fa-map-o" aria-hidden="true"></i>
                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-2 col-sm-offset-7 pull-right">

                                <div class="eventActionContents">
                                    {!! csrf_field() !!}
                                    @if(\Auth::check())
                                        <button id="event_signup" class="btn btn-success">Sign up</button>
                                        <span id="signupError" class="help-block"></span>
                                        <input name="user_id" type="hidden" value="{{\Auth::user()->id}}">
                                    @else
                                        <div class="loginRequest">
                                            <h3>You must be logged in to signup!</h3>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="hr">
                        <div class="eventBody col-xs-12 col-sm-10 col-sm-offset-1">

                            <p>{{$event->description}}</p>
                        </div>
                    </div>

                        <div id="map" class="row well"></div>




                        <!-- Modal -->
                        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="message">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {!! csrf_field() !!}
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">To: <a href="https://facebook.com/{{$user->facebook_id}}"><img src="{{$user->avatar}}" height="15px" width="15px"><span class="eventCardUserName"> {{$user->name}}</span></a></h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="message_body" placeholder="Type Message">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{--Sign Up Success Modal--}}
                        <div class="modal fade" id="signupSuccess" tabindex="-1" role="dialog" aria-labelledby="success">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    </div>
                                    <div class="modal-body">
                                        <h3>Sweet! You're signed up!</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Exit</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('javascript')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7qdWOMCx2T_bN06rPxVogSLGaVfhp5hQ&callback">
    </script>
    <script src="{{URL::to('src/js/Map.js')}}"></script>
@endsection