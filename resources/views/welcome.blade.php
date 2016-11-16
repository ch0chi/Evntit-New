@extends('layouts.app')

@section('content')
<div id="homeWrapper" class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="searchBar" class="container">
                <div class="row">
                    <div id="logo">
                        <img src="{{URL::to('src/Images/logoBlue.png')}}">
                        <h1>What are you going to do today?</h1>
                    </div>

                    <div id="filter-panel" class=" filter-panel">
                        <div id="search" class="panel">
                            <div class="panel-body">
                                <form class="form-inline" method="post" action="{{ url('/search') }}" role="form" enctype="multipart/form-data" autocomplete="off">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label class="filter-col"  for="category">I'm looking for:</label>
                                        <select  id="category" name="category" class="form-control" required>
                                            <option value="" disabled selected>Select a Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div> <!-- form group [rows] -->
                                    <div class="form-group">
                                        <label class="filter-col" for="locationSearch">Near:</label>
                                        <input id="locationSearch" type="text" class="form-control adInput" name="location"  value="{{ old('location') }}">
                                        <div class="col-xs-12">
                                            <ul class="center-block" id="suggestion-box">
                                                <li id="beforeSearchText"><i>Search for a city</i></li>
                                            </ul>
                                        </div>
                                        <button id="searchButton" class="btn btn-default" type="submit" onclick=""><i class="fa fa-search"></i></button>
                                    </div><!-- form group [search] -->
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
