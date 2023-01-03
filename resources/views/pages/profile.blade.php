@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out1">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-4 mb-4">
                        <p class ="h2 fw-bold"> Overview </p>
                        <p class ="h4"> Check information on the user! </p>
                    </div>
                    <div class = "ms-3">
                        <div class = "d-flex">
                            <div class="mb-4 lg">
                                <?php
                                if(file_exists('images/users/'.$user->idclient.'.jpg')) {
                                    $path = '/images/users/'.$user->idclient.'.jpg';
                                }
                                else {
                                    $path = "/images/users/def.png";
                                }
                                ?>
                                <img src= "{{$path}}" width="200" height="200" alt='User Image'>
                            </div>
                            <div class = "ms-4 mt-3">
                                <p class = "mt-3 mb-2 ms-3 h4 fw-bold">{{$user->firstname}} {{$user->lastname}}</p>
                                <p class = "mb-2 ms-3 h5 mt-4">Rating</p>
                                <?php
                                    $own = \App\Models\AuctionOwner::find($user->idclient);
                                    if(!is_null($own)) {
                                        if((string) $own->rating === "") {
                                            $rating = "0";
                                        }
                                        else {
                                            $rating = $own->rating;
                                        }
                                    }
                                    else {
                                        $rating = "0";
                                    }
                                ?>
                                <p class = "mb-3 ms-3 h3 cor ">{{$rating}}</p>
                            </div>
                        </div>
                        <div class = "d-flex">
                            <div class = "d-flex fii high">
                                <i class="fa-solid fa-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">About</button>
                            </div>
                            <div class = "d-flex ms-5 fii">
                                <i class=" fa-solid fa-house-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">Auctions</button>
                            </div>
                        </div>
                        <hr class = "mt-0 mb-3">
                        <div class = "about">
                            <span class = "cor2 h4"> Contact Information </span>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Name: </span>
                                <span class = "h5 ms-2"> {{$user->firstname}} {{$user->lastname}} </span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Address: </span>
                                <span class = "h5  ms-2"> {{$user->address}}</span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Email: </span>
                                <span class = "h5  ms-2"> {{$user->email}}</span>
                            </div>
                            <div class = "d-flex mt-3 mb-5">
                                <span class = "h5 fw-bold"> Phone Number: </span>
                                <span class = "h5 ms-2"> {{$user->phonenumber}}</span>
                            </div>
                        </div>
                        <div class = "auctions mb-4">
                            <span class = "cor2 h4 mb-5"> Owned Auctions </span>
                            @if(count($auctions)==0)
                                <div>You have no auctions. Click <a href="{{route('createAuction')}}"><u>here</u></a> to create one</div>
                            @else
                                @foreach($auctions as $auct)
                                    <div class = "d-flex mt-2 mb-5 centro">
                                        <a href = "{{route('auction',['id' => $auct->idauction])}}"> <img class ="endimg img-fluid" width="193" height="230" src= "/images/{{$auct->idauction}}/1.jpg" alt='Auction Image'> </a>
                                        <div class ="mb-4">
                                            <div>
                                                <p class = "h5 ms-4 mt-2 cor2 fw-bold mb-0"> Auction Name:</p>
                                                <p class = "h5 ms-4 mt-0"> {{$auct->name}}</p>
                                            </div>
                                            <div>
                                                <p class = "h5 ms-4 mt-3 cor2 fw-bold"> Price:</p>
                                                <p class = "h5 ms-4 mt-0"> {{$auct->currentprice}}€</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
