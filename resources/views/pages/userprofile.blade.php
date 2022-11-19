@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out1">
        <div class="prof d-flex">
            <div id="aside">
                <div class="hi d-flex pt-4 pb-4">
                    <div class="lg">
                        <img src= "/alo.jpg" width="120" height="120">
                    </div>
                    <div class="nome ms-2 me-2">
                        <p class = "fw-bold mb-1">Hi,</p>
                        <p class = "fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>
                    </div>
                </div>
                <ul class = "ps-0 mt-2">
                    <li>
                        <a href = "{{route('profile')}}"><button class = "fw-bold">
                                <i class="fa-solid fa-user"></i>
                                Account Overview
                            </button> </a>
                    </li>

                        <a href="{{route('logout')}}"><button class = "fw-bold">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-4 mb-4">
                        <p class ="h2 fw-bold"> Overview </p>
                        <p class ="h4"> Check information on the user! </p>
                    </div>
                    <div class = "ms-3">
                        <div class="lg mb-4">
                            <img src= "../alo.jpg" width="120" height="120">
                        </div>
                        <div>
                            <p class = "mb-0 ms-3 fw-bold infopp">Name: </p>
                            <p class = "mb-2 ms-3 f infopp">{{$user->firstname}} {{$user->lastname}} </p>
                            <p class = "mb-0 ms-3 fw-bold infopp">Email: </p>
                            <p class = "mb-2 ms-3 f infopp">{{$user->email}} </p>
                            <p class = "mb-0 ms-3 fw-bold infopp">Phone Number: </p>
                            <p class = "mb-2 ms-3 f infopp">{{$user->phonenumber}} </p>
                            <p class = "mb-0 ms-3 fw-bold infopp">Rating: </p>
                            <p class = "mb-2 ms-3 f infopp">5.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
