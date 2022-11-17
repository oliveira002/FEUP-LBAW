@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out5">
        <div class="prof d-flex">
            @include('partials.sidebar')
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
