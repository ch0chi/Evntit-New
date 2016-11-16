@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{URL::to('src/bower_components/pickadate/lib/compressed/themes/default.css')}}">
    <link rel="stylesheet" href="{{URL::to('src/bower_components/pickadate/lib/compressed/themes/default.date.css')}}">
    <link rel="stylesheet" href="{{URL::to('src/bower_components/pickadate/lib/compressed/themes/default.time.css')}}">
@endsection
@section('content')
    <div id="makeEventWrapper" class="container-fluid">
        <div id="addEventHeader" class="center-all">
            <h1 class="popout-text">Add an Event</h1>
        </div>
        <div id="makeEventInnerWrapper" class="container">
            <div class="row">
                <div class="addEvent">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/event') }}" enctype="multipart/form-data" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <div class="form-group{{$errors->has('event_image') ? ' has-error' : ''}} center-all">
                                    <label for="event_image" class="formImage center-all"><h5>Add an image</h5><img id="uploadImage" src="{{URL::to('src/Images/camera.png')}}" class="img-responsive"></label>
                                    <input type="file" id="event_image" name="event_image" class="hidden">
                                    @if ($errors->has('event_image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group{{ $errors->has('event_name') ? ' has-error' : '' }}">
                                    <label class=" control-label">Event Name</label>

                                    <div class="">
                                        <input type="text" class="form-control adInput" name="event_name" value="{{ old('event_name') }}">

                                        @if ($errors->has('event_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('event_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label class=" control-label">Category</label>

                                    <div class="">
                                        <select  id="category" name="category" class="form-control " required>
                                            <option value="" disabled selected>Select a Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="control-label">Description</label>

                                    <div class="">
                                        <textarea id="addEventDescription" type="text" class="form-control adInput" name="description" placeholder="What are the details?"></textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                    <label class=" control-label">Location</label>

                                    <div class="">
                                        <input id="locationSearch" type="text" class="form-control adInput" name="location"  value="{{ old('location') }}">

                                        @if ($errors->has('location'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                        @endif

                                            <ul class="center-block" id="suggestion-box">
                                                <li id="beforeSearchText"><i>Search for a city</i></li>
                                            </ul>

                                    </div>

                                </div>
                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label class="control-label">Date</label>

                                    <div class="">
                                        <input type="datetime" class="form-control datepicker" name="date" value="{{ old('date') }}">

                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                    <label class=" control-label">Time</label>

                                    <div class="">
                                        <input type="datetime" class="form-control timepicker" name="time" value="{{ old('time') }}">

                                        @if ($errors->has('time'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Make Event</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{URL::to('src/bower_components/pickadate/lib/compressed/picker.js')}}"></script>
    <script src="{{URL::to('src/bower_components/pickadate/lib/compressed/picker.date.js')}}"></script>
    <script src="{{URL::to('src/bower_components/pickadate/lib/compressed/picker.time.js')}}"></script>
    <script src="{{URL::to('src/bower_components/pickadate/lib/compressed/legacy.js')}}"></script>
    <script src="{{URL::to('src/js/datepicker.js')}}"></script>
@endsection