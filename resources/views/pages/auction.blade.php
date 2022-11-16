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
            <div class = "d-flex">
                <div class="foto">
                    <img src = "item.jpg" width= "400" height = "510">
                </div>
                <div class="infos mt-4 ms-4">
                    <p class = "fw-bold h3"> {{$auction->name}}</p>
                </div>
            </div>
        </div>
@endsection
