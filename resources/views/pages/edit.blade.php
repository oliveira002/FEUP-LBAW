@extends('layouts.app')

<?php
$day=$auction->enddate->format('d');
$month=$auction->enddate->format('m');
$hour=$auction->enddate->format('H');
$mins=$auction->enddate->format('i');
$monthstr=$auction->enddate->format('M');
$year=$auction->enddate->format('Y');
$secs=$auction->enddate->format('s');
if ($hour / 10 < 0) {
    $hour="0" . $hour;
}
if ($mins / 10 < 0) {
    $mins="0" . $mins;
}
$finalStr=$year . '-' . $month . '-' . $day . 'T' . $hour . ':' . $mins;
$minBid=0.05 * $auction->startingprice;
$minBid=" " . ($minBid + $auction->currentprice);
?>



@section('content')
    <div class="page">
        <form action="{{route('updateAuction',['id' => $auction->idauction])}}" method="POST" class="d-flex" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div>
                <div class="foto">
                    <img class="img-fluid" src="/images/{{$auction->idauction}}/1.jpg" width="400" height="510" alt='Auction Image'>
                </div>
                <div class="uppic mb-2">
                    <label for="auc_pic"><i class="fa-solid fa-cloud-arrow-up"></i>Change picture</label>
                    <input name="auc_pic" id="auc_pic" class="img-fluid" type="file" accept="image/jpeg, image/png" width="400" height="510" style="display: none">
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
                <div>
                    <div class="form-header">
                        <div class="title">
                            <h1>Edit Auction</h1>
                        </div>
                    </div>
                    <div class="input-group">
                        <div>
                            <div class="input-box">
                                <label for="name">Auction Name:</label>
                                <input id="name" type="text" name="name" value="{{$auction->name}}" required>
                            </div>
                            <div class="input-box">
                                <label for="cats">Category:</label>
                                <select id="cats" name="cat">
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->idcategory}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-box">
                                <label for="desc">Auction Description:</label>
                                <textarea id="desc" name="desc" required>{{$auction->description}}</textarea>
                            </div>
                            <div class="input-box">
                                <label for="price">Auction Starting Price:</label>
                                <input id="price" type="number" name="price" step="0.01" min="1" value="{{$auction->startingprice}}" required>
                            </div>
                            <div class="input-box">
                                <label for="enddate">Auction End Date:</label>
                                <input id="enddate" type="datetime-local" name="enddate" value="{{$finalStr}}" required>
                            </div>
                            <div class="continue-button mb-3">
                                <input type="submit" class="continue-button" value="Save Changes"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection
