@extends('layouts.app')

<?php
    $day = $auction->enddate->format('d');
    $month = $auction->enddate->format('F');
    $hour = $auction->enddate->format('G');
    $mins = $auction->enddate->format('i');
    $monthstr = $auction->enddate->format('M');
    $year = $auction->enddate->format('Y');
    $secs = $auction->enddate->format('s');
    if($hour / 10 >0) {
        $hour = "0" . $hour;
    }
    $finalStr = $monthstr.  " " .  $day. "," . " "  .$year . " " . $hour.":".$mins.":".$secs;
    $minBid = 1.05 * $auction->startingprice;
?>



@section('content')
        <div class = "page">
            <div class = "d-flex">
                <div>
                    <div class="foto">
                        <img src = "../item.jpg" width= "400" height = "510">
                    </div>
                    <div class = "mt-2 hist">
                        <p class = "h2 fw-bold mb-0"> Current Bid: </p>
                        <p class = "pp fw-bold mb-0"> {{$auction->currentprice}}€</p>
                    </div>
                    <div class = "text-center">
                        <p class = "h4 fw-bold mb-2"> View Bidding History: </p>
                        <p> Bidder 4 - 28th September   1600€</p>
                        <p> Bidder 3 - 28th September   1600€</p>
                        <p> Bidder 2 - 28th September   1600€</p>
                        <p> Bidder 1 - 28th September   1600€</p>

                    </div>
                </div>
                <div class="infos ms-4">
                    <p class = "details fw-bold h5 mb-0"> Product Details: </p>
                    <div class="texto">
                        <p class = "fw-bold">{{$auction->description}}</p>
                    </div>
                </div>
                <div class="bids ms-4">
                    <p class = "details fw-bold h5 mb-0"> Name: </p>
                    <div>
                        <p class = "fw-bold"> {{$auction->name}} </p>
                    </div>
                    <p class = "details fw-bold h5 mb-0"> Initial Price: </p>
                    <div>
                        <p class = "fw-bold">{{$auction->startingprice}}€</p>
                    </div>
                    <p class = "details fw-bold h5 mb-0"> Auction Ends In: </p>
                    <div>
                        <p class = "fw-bold">24h</p>
                    </div>
                    <p class = "details fw-bold h5"> Bid Price (€): </p>
                    <div class="acts">
                        <input type="number" class="inpt ps-1 fw-bold" name = "name" value = "{{$minBid}}" min= {{$minBid}}>
                        <div class = "mt-4">
                            <a class = "bidbtn text-center" href = "">
                                <button class = "fw-bold">
                                     Place Bid 
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
