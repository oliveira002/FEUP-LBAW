@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class = "cover out1">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf mt-4 mb-4">
                        <p class ="h2 fw-bold mb-4"> Dashboard </p>
                        <div class = "rect">
                            <p class = "txtt2"> You are in the admin panel, here you can administrate the website.</p>
                        </div>
                        <div class = "d-flex mt-4 numbers">
                            <div class = "d-flex boxi">
                                <img class = "fill" src= "/user.png" width="50" height="50" alt="User Logo">
                                <div class = "ms-2">
                                    <span class = "h5"> Total </span>
                                    <p class = "h5 mb-0"> Costumers </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numUsers}} </p>
                                </div>
                            </div>
                            <div class = "d-flex boxi ms-5">
                                <img class = "fill" src= "/numauc.png" width="50" height="50" alt="Auctions Logo">
                                <div class = "ms-2">
                                    <span class = "h5"> Total </span>
                                    <p class = "h5 mb-0"> Auctions </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numAuc}} </p>
                                </div>
                            </div>
                            <div class = "d-flex boxi ms-5">
                                <img class = "fill" src= "/numbid.png" width="50" height="50" alt="Bids Logo">
                                <div class = "ms-2">
                                    <span class = "h5"> Total</span>
                                    <p class = "h5"> Bids </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numBids}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
