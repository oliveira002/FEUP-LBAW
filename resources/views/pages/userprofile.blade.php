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
                    <div class="nome ms-3 me-2">
                        <p class = "fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>
                    </div>
                </div>
                <ul class = "ps-0 mt-2">
                    <li>
                        <a href = "{{route('profile',['username' =>$user->username])}}"><button class = "fw-bold">
                                <i class="fa-solid fa-user"></i>
                                Account Overview
                            </button> </a>
                    </li>
                    <li>

                        <a href="{{route('editusers',['username' => $user->username])}}"><button class = "fw-bold">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Edit User</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{url()->previous()}}"><button class = "fw-bold">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Go Back</button>
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
                        <div class = "d-flex">
                            <div class="mb-4 lg">
                                <img src= "../alo.jpg" width="200" height="200">
                            </div>
                            <div class = "ms-4 mt-3">
                                <p class = "mt-3 mb-2 ms-3 h4 fw-bold">{{$user->firstname}} {{$user->lastname}}</p>
                                <p class = "mb-2 ms-3 h5 mt-4">Rating</p>
                                <p class = "mb-3 ms-3 h3 cor ">5.0</p>
                                <a href = "" class = "mb-2 ms-3 h5 rep mt-2"><button> Report user <i class="fa-regular fa-thumbs-down"></i>  </button> </a>
                            </div>
                        </div>
                        <div class = "d-flex">
                            <div class = "d-flex fii high">
                                <i class="fa-solid fa-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">About</button>
                            </div>
                            <div class = "d-flex ms-5 fii">
                                <i class=" fa-solid fa-house-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">Auctions</button>
                            </div>
                        </div>
                        <hr class = "mt-0 mb-3">
                        <div class = "about">
                            <span class = "cor2 h4"> Contact Information </span>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Name: </span>
                                <span class = "h5 ms-2"> {{$user->firstname}} {{$user->lastname}} </span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Address: </span>
                                <span class = "h5  ms-2"> {{$user->address}}</span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Email: </span>
                                <span class = "h5  ms-2"> {{$user->email}}</span>
                            </div>
                            <div class = "d-flex mt-3 mb-5">
                                <span class = "h5 fw-bold"> Phone Number: </span>
                                <span class = "h5 ms-2"> {{$user->phonenumber}}</span>
                            </div>
                        </div>
                        <div class = "auctions mb-4">
                            <span class = "cor2 h4 mb-5"> Owned Auctions </span>
                            @foreach($auctions as $auct)
                                <div class = "d-flex mt-2 mb-5">
                                    <a href = "{{route('auction',['id' => $auct->idauction])}}"> <img class ="endimg" src= "/images/{{$auct->idauction}}/1.jpg" width="193" height="130"> </a>
                                    <div class ="mb-4">
                                        <div>
                                            <p class = "h5 ms-4 mt-2 cor2 fw-bold mb-0"> Auction Name:</p>
                                            <p class = "h5 ms-4 mt-0"> {{$auct->name}}</p>
                                        </div>
                                        <div>
                                            <p class = "h5 ms-4 mt-3 cor2 fw-bold"> Price:</p>
                                            <p class = "h5 ms-4 mt-0"> {{$auct->currentprice}}€</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
