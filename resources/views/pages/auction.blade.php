@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class = "col-md-4">
                <p> {{$auction->name}} </p>
            </div>
            <div class = "col-md-4">
                <p> {{$auction->name}} </p>
            </div>
            <div class = "col-md-4">
                <p> {{$auction->name}} </p>
            </div>
        </div>
    </div>
@endsection
