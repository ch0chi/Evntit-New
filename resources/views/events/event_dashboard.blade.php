@extends('layouts.app')

@section('content')
    <div class="container eventPanelWrapper">
        <div class="row eventPanelRow">
            <div class="col-md-12">
                <h1>Event Dashboard</h1>
            </div>
            <a href="{{URL::to('events/add_event')}}">
                <div class="col-sm-12 eventLink">
                    <button class="btn btn-success btn-lg center-block">Add event</button>
                </div>
            </a>

        </div>
    </div>
@endsection