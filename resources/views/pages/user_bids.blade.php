@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover">
        <div class="prof d-flex out4">
            @include('partials.sidebar')
            <div class="myBids">
                <div class="spec d-flex flex-column ps-3 pe-3" id="user-auctions">
                    <div class = "stuf ms-3 mt-4 mb-4">
                        <div class = "stuf ms-3 mt-5 mb-4">
                            <h1 class = "fw-bold">My Bids</h1>
                            <p class = "fw-bold">Here you can see all your bids</p>
                            <hr class = "mt-3 mb-3">

                            @foreach($bids as $bid)

                                <?php
                                    $auction = \App\Models\Auction::find($bid->idauction);
                                    ?>
                                <div class = "row">
                                    <div class = "col-3">
                                        <img src= "/images/{{$auction->idauction}}/1.jpg" width="130" height="95" alt='Auction Image'>
                                    </div>
                                    <div class = "col-9">
                                        <div class = "row">
                                            <div class = "col-12" id="item-info">
                                                <p class = "fw-bold fs-5">{{$auction->name}}</p>
                                            </div>
                                            <div class = "col-12" id="item-info">
                                                <p class = "fw-bold">Your bid: {{$bid->price}}€</p>
                                            </div>
                                            <div class = "col-12" id="item-info">
                                                <p class = "fw-bold">Current bid: {{$auction->currentprice}}€</p>
                                            </div>
                                            <div class = "col-12" id="item-info">
                                                <p class = "fw-bold">Ends at: {{$auction->enddate}}</p>
                                            </div>
                                            <div class = "col-12" id="item-info">
                                                <form action="{{route('auction', $auction->idauction)}}" method="GET">
                                                    @csrf
                                                    <button type="submit" class= "fw-lighter btn btn-secondary btn-sm">Bid</button>
                                                </form>

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
