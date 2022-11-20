@extends('layouts.app')

<?php
$day = $auction->enddate->format('d');
$month = $auction->enddate->format('F');
$hour = $auction->enddate->format('G');
$mins = $auction->enddate->format('i');
$monthstr = $auction->enddate->format('M');
$year = $auction->enddate->format('Y');
$secs = $auction->enddate->format('s');
if ($hour / 10 > 0) {
    $hour = "0" . $hour;
}
$finalStr = $monthstr . " " . $day . "," . " " . $year . " " . $hour . ":" . $mins . ":" . $secs;
$minBid = 0.05 * $auction->startingprice;
$minBid = " " . ($minBid + $auction->currentprice);
?>



@section('content')
    <div class="page">
        <div class="d-flex">
            <div>
                <div class="foto">
                    <img class="img-fluid" src="/images/{{$auction->idauction}}/1.jpg" width="400" height="510">
                </div>
            </div>
            <div class="contii">
                @if($errors->has('error'))
                    <div class="mb-0 mt-2 alert alert-danger">
                        <ul class="ps-0">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('updateAuction',['id' => $auction->idauction])}}" method="POST">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-header">
                        <div class="title">
                            <h1>Edit Auction</h1>
                        </div>
                    </div>
                    <div class="input-group">
                        <div>
                            <div class="input-box">
                                <label for="firstname">Auction Name:</label>
                                <input id="firstname" type="text" name="nome" value="{{$auction->name}}" required>
                            </div>
                            <div class="input-box">
                                <label for="firstname">Category:</label>
                                <select id="cats" name="cats">
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->name}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-box">
                                <label for="desc">Auction Description:</label>
                                <input id="desc" type="text" name="desc" value="{{$auction->description}}" required>
                            </div>
                            <div class="input-box">
                                <label for="price">Auction Starting Price:</label>
                                <input id="price" type="text" name="price" value="{{$auction->startingprice}}€" required>
                            </div>
                            <div class="input-box">
                                <label for="enddate">Auction End Date:</label>
                                <input id="enddate" type="text" name="enddate" value="{{$auction->enddate}}" required>
                            </div>
                            <div class="continue-button">
                                <input type="submit" class="continue-button" value="Save Changes"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
