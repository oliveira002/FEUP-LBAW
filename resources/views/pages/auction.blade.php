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
?>



@section('content')
        <div class = "page">
            <div class = "top d-flex">
                <div class = "details">
                    <p class = "h2 text-uppercase fw-bold"> {{$auction->name}}</p>
                    <p class = "h3 fw-bold"> Auction ends on the {{$day}}th {{$month}} at  {{$hour}}h:{{$mins}}m </p>
                </div>
                <div class = "seller d-flex">
                    <div class = "pers">
                        <img src="../alo.jpg" width= "100" height= 100">
                    </div>
                    <div class = "info">
                       <p class = "fw-bold"> {{$owner->firstname}} {{$owner->lastname}} </p>
                        <p class = "fw-bold"> {{$owner->phonenumber}} </p>
                        <p class = "fw-bold"> {{$owner->email}}</p>
                    </div>
                </div>
            </div>

            <hr class = "line">
            <div class = "infoprod d-flex">
                <div class = "product">
                    <img src="../item.jpg" width= "360" height= 300">
                </div>
                <div class = "desc">
                    <p class = "fw-bold"> {{$auction->description}}</p>
                </div>
                <div class = "acts">
                    <p class = "h3 fw-bold" id = "dt"> </p>
                </div>
            </div>
        </div>
@endsection
