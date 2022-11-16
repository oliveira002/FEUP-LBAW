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
                </div>
                <div class = "texto ms-5">
                    <p class = "h3 fw-bold"> {{$auction->name}}</p>
                    <p class = "h5 fw-bold"> Current Bid: {{$auction->currentprice}}€</p>
                    <div class = "caixa">
                        <div class ="ms-3">
                            <p class = "h5 fw-bold pt-5 pb-2"> Time Left: </p>
                            <div class = "d-flex pt-2 pb-2">
                                <p class = "h4 me-2 fw-bold"> 01 </p>
                                <p class = "h4 me-2"> Days </p>
                                <p class = "h4 me-2 fw-bold"> 13 </p>
                                <p class = "h4 me-2"> Hours </p>
                                <p class = "h4 me-2 fw-bold"> 29 </p>
                                <p class = "h4 me-2"> Minutes </p>
                                <p class = "h4 me-2 fw-bold"> 05 </p>
                                <p class = "h4 me-2"> Seconds </p>
                            </div>
                            <p class = "h5 fw-bold pt-2 pb-2"> Auction Ends: </p>
                            <p class = "h5 me-2 fw-bold pb-5"> {{$auction->enddate}} </p>
                        </div>
                    </div>
                    <div class = "caixa2">
                        <div class ="ms-3">
                            <p class = "h5 fw-bold pt-2 pb"> This is a bidding fee auction. </p>
                            <p class = "h5 fw-bold pb-2"> All participants must put a bid of minimum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
