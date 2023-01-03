@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class="cover out7">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class="myAuctions">
                <div class="spec d-flex flex-column ps-3 pe-3" id="user-auctions">
                    <div class="stuf ms-3 mt-4 mb-4">
                        <div class="stuf ms-3 mt-5 mb-4">
                            <div class="d-flex">
                                <h1 class="fw-bold">My Winnings</h1>
                            </div>
                            <p class="fw-bold">Here you can see all your winnings!</p>
                            <hr class="mt-3 mb-3">
                            @if(count($auctions)==0)
                                <div>You never won an auction :| </div>
                            @else
                                @foreach($auctions as $auct)
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="/images/{{$auct->idauction}}/1.jpg" width="130" height="95" alt='Auction Image'>
                                        </div>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="col-12" id="item-info">
                                                    <p class="fw-bold fs-5">{{$auct->name}}</p>
                                                </div>
                                                <div class="col-12 " id="item-info">
                                                    <p class="fw-bold">Winning Bid: {{$auct->currentprice}}€</p>
                                                </div>
                                                <div class="col-12" id="item-info">
                                                    <p class="fw-bold">Ended: {{$auct->enddate}}</p>
                                                </div>
                                                <div class="col-12" id="item-info">
                                                    <a href="{{route('auction',['id' => $auct->idauction])}}">
                                                        <button class="fw-bold btn btn-secondary btn-sm">View Auction
                                                        </button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-3 mb-3">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
