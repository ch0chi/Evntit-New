@extends('layouts.app')

@section('content')

    <div id="404" class="container-fluid">
        <h1>Oh no! Looks like the page you were looking for wasn't found!</h1>
        <p>Reason: {{$error or 'Please try a different page.'}}</p>
    </div>
@endsection