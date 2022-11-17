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
    $minBid = 0.05 * $auction->startingprice;
    $minBid = " " . ($minBid + $auction->currentprice);
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
                    <div class = "ola d-flex">
                        <p class = "h3 fw-bold me-3"> {{$auction->name}}</p>
                    </div>
                    <p id = "ini" class = "h5 pb-2"> Current Bid: <span id = "pl" class = "h4 pb-2">{{$auction->currentprice}}€</span> </p>
                    <div class = "caixa mb-4">
                        <div class ="ms-3">
                            <p class = "h5 fw-bold pt-4 pb-2 defl"> Time Left: </p>
                            <div class = "d-flex pt-2 pb-2">
                                <p class = "h4 me-2 fw-bold"> 01 </p>
                                <p class = "h5 me-2"> Days </p>
                                <p class = "h4 me-2 fw-bold"> 13 </p>
                                <p class = "h5 me-2"> Hours </p>
                                <p class = "h4 me-2 fw-bold"> 29 </p>
                                <p class = "h5 me-2"> Minutes </p>
                                <p class = "h4 me-2 fw-bold"> 05 </p>
                                <p class = "h5 me-2"> Seconds </p>
                            </div>
                            <p class = "h5 fw-bold pt-2 pb-2 defl"> Auction Ends: </p>
                            <p class = "h5 me-2 pb-4"> {{$auction->enddate}} </p>
                        </div>
                    </div>
                    <div class = "caixa2 mb-2">
                        <div class ="ms-3">
                            <p class = "h5 fw-bold pt-2"> There is a minimum increase of 5% for each bid. </p>
                            <div class = "d-flex">
                                <p id = "nr" class = "h5 pb-2"> The minimum bid amount right now is <span id = "pp" class = "h4 pb-2">{{$minBid}}€</span> </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class = "h5 fw-bold pt-3 defl"> Your Bid: </p>
                        <input type="float" class= "inpt p-1" placeholder="{{$minBid}}"  name="amount" min= "{{$minBid}}">
                        <div class = "mt-3">
                            <a class = "bidbtn text-center" href = "">
                                <button class = "fw-bold">
                                    Bid Now
                                </button>
                            </a>
                        </div>
                        <div class = "fav d-flex mt-4">
                            <div class = "me-4">
                                <i class="fa-solid fa-user-tag"></i>
                                <a href class = "pop"> Seller Profile </a>
                            </div>
                            <div class = "me-4">
                                <i class="fa-regular fa-star"></i>
                                <a href class = "pop"> Add to favourites </a>
                            </div>
                        </div>
                        <hr class = "mt-3 mb-3">
                        <div class = "d-flex">
                            <span class = "fw-bold"> Auction Owner: </span>
                            <span class = "ms-2"> {{$owner->firstname}} {{$owner->lastname}}</span>
                        </div>
                        <div class = "d-flex">
                            <span class = "fw-bold"> Rating: </span>
                            <span class = "ms-2"> 5.0</span>
                        </div>
                        <div class = "d-flex">
                            <span class = "fw-bold"> Category: </span>
                            <span class = "ms-2"> {{$category->name}} </span>
                        </div>
                        <div class = "d-flex">
                            <div>
                                <span class = "fw-bold"> Description: </span>
                            </div>
                            <span class = "ms-2 dtls"> {{$auction->description}}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
