@extends('layouts.app')


@section('content')
    <div class="cover">
        <div class="row justify-content-md-center">
            <div class = "col col-md-6">
                <p class = "fw-bold fs-2"> Categories </p>
            </div>
        </div>
            @foreach($categories->chunk(3) as $chunk)
                <div class="row justify-content-md-center mb-4">
                    @foreach($chunk as $add)
                        <div class="col-md-2">
                            <div class = "item">
                                <img src= "alo.jpg" width="200" height="150">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
    </div>
        <div class="cover2">
            <div class="row justify-content-md-center ">
                <div class = "col col-md-6">
                    <p class = "fw-bold fs-2"> Ending Soon! </p>
                </div>
            </div>
            <div class="row justify-content-md-center mb-5">
                @foreach($auctions as $auct)
                    <div class="col-md-2">
                        <div class = "item">
                            <img src= "alo.jpg" width="200" height="150">
                            <div class = "prop">
                                <p class = "fw-bold"> {{$auct->name}} </p>
                                <p class = "fw-bold"> {{$auct->currentprice}}$ </p>
                                <p class = "fw-bold"> {{$auct->enddate}} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
