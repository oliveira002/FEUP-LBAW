@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out5">
        <div class="prof d-flex">
            <div id="aside">
                <div class="hi d-flex pt-4 pb-4">
                    <div class="lg">
                        <img src= "/alo.jpg" width="120" height="120">
                    </div>
                    <div class="nome ms-2">
                        <p class = "fw-bold mb-1">Hi,</p>
                        <p class = "fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>

                    </div>
                </div>
                <ul class = "ps-0 mt-2">
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-user"></i>
                                Account Overview
                            </button> </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-address-card"></i>
                                My Details
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-wallet"></i>
                                My Wallet
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-coins"></i>
                                My Bids</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-house-user"></i>
                                My Auctions</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-star"></i>
                                Favourites</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-question"></i>
                                Support</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="myAuctions">
                <div class="spec d-flex flex-column ps-3 pe-3" id="user-auctions">
                    <div class = "stuf ms-3 mt-5 mb-4">
                        <div class = "stuf ms-3 mt-5 mb-4">
                            <h1 class = "fw-bold">My Auctions</h1>
                            <p class = "fw-bold">Here you can see all your auctions</p>

                        </div>
                    <div class = "stuf ms-3 mt-5 mb-4">
                        <hr class = "mt-3 mb-3">
                        @foreach($auctions as $auct)


                            <div class = "row">
                                <div class = "col-3">
                                    <img src= "/item.jpg" width="130" height="95">
                                </div>
                                <div class = "col-9">
                                    <div class = "row">
                                        <div class = "col-12" id="item-info">
                                            <p class = "fw-bold fs-5">{{$auct->name}}</p>
                                        </div>
                                        <div class = "col-12 " id="item-info">
                                            <p class = "fw-bold">Current Bid: {{$auct->currentprice}}€</p>
                                        </div>
                                        <div class = "col-12" id="item-info">
                                            <p class = "fw-bold">Ends: {{$auct->enddate}}</p>
                                        </div>
                                        <div class = "col-12" id="item-info">
                                            <button class = "fw-bold btn btn-secondary btn-sm">View Auction</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <hr class = "mt-3 mb-3">

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
