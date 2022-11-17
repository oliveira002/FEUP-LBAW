@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out1">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-5 mb-4">
                        <p class ="h2 fw-bold"> Overview </p>
                        <p class ="h4"> Check information on the user! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
