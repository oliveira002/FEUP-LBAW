@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class="cover out1">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf ms-3 mt-4 mb-4">
                        <p class="h2 fw-bold"> Overview </p>
                        <p class="h4"> Check information on the user! </p>
                    </div>
                    <div class="ms-3">
                        <div class="lg mb-4">
                            <img src="../alo.jpg" width="120" height="120">
                        </div>
                        <div>
                            <p class="mb-0 ms-3 fw-bold infopp">Name: </p>
                            <p class="mb-2 ms-3 f infopp">{{$user->firstname}} {{$user->lastname}} </p>
                            <p class="mb-0 ms-3 fw-bold infopp">Email: </p>
                            <p class="mb-2 ms-3 f infopp">{{$user->email}} </p>
                            <p class="mb-0 ms-3 fw-bold infopp">Phone Number: </p>
                            <p class="mb-2 ms-3 f infopp">{{$user->phonenumber}} </p>
                            <p class="mb-0 ms-3 fw-bold infopp">Rating: </p>
                            <p class="mb-2 ms-3 f infopp">5.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
