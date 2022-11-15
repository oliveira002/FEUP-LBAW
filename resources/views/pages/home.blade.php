@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row flex-wrap justify-content-center ">
            <p class = "fw-bold fs-2"> Categories </p>
        </div>
            @foreach($categories->chunk(3) as $chunk)
                <div class="d-flex flex-row flex-wrap justify-content-center ">
                    @foreach($chunk as $add)
                        <div class="d-flex flex-column p-3">
                            <div class = "item">
                                <img src= "alo.jpg" width="287" height="190">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
    </div>
    <div class="container-fluid">
        <div class="d-flex flex-row flex-wrap justify-content-center ">
            <p class = "fw-bold fs-2 mb-0"> Ending Soon! </p>
        </div>
        <div class="d-flex flex-row flex-wrap justify-content-center ">
            @foreach($auctions as $auct)
                <div class="d-flex flex-column p-3">
                    <div class = "item">
                        <img src= "alo.jpg" width="287" height="190">
                        <div class = "prop">
                            <p class = "fw-bold "> {{$auct->name}} </p>
                            <p class = "fw-bold"> {{$auct->currentprice}}$ </p>
                            <p class = "fw-bold"> {{$auct->enddate}} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
