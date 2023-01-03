@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="cover out4">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf mt-4 mb-4">
                        <div class="d-flex query mt-4">
                            <p class ="h3 fw-bold"> All Bids </p>
                            <div class="search2">
                            </div>
                        </div>
                        <div class="tableContainer">
                            <table class="table oview mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Auction ID</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bids as $bid)
                                        <?php
                                            $user=\App\Models\User::find($bid->idclient);
                                            $auction=\App\Models\Auction::find($bid->idauction);

                                            if($bid->isvalid){
                                                $valid="Valid";
                                            }
                                            else{
                                                $valid="Invalid";
                                            }
                                        ?>
                                    <div class="d-flex align-items-center">
                                        <tr>
                                            <th class="fw-bold">{{$bid->idbid}}</th>
                                            <td>
                                                <span class=" fw-light">{{$user->firstname }} {{$user->lastname}}</span>
                                            </td>
                                            <td class="mt-3">
                                                {{$bid->idauction}}

                                            </td>
                                            <td class="mt-3">{{$bid->price}}€</td>
                                            <td class="d-flex justify-content-center">
                                                <a onclick="valid()" class="open-modal fw-bold linkii" data-target="modal-{{$bid->idbid*2}}"> <i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    </div>
                                        <div id="modal-{{$bid->idbid*2}}" class="modal-window">
                                            <div class="d-flex">
                                                <h2>Bid Information</h2>
                                                <button class="close modal-hide"><i class="fa-solid fa-x "></i></button>
                                            </div>
                                            <div class="d-flex">
                                                <div class="d-flex flex-column">
                                                    <p class="rfix">Bid Id: <span class="fw-bold"> {{$bid->idbid}} </span> </p>
                                                    <p class="rfix">Bid Date: <span class="fw-bold"> {{$bid->biddate}} </span> </p>
                                                    <p class="rfix">Bid: <span class="fw-bold bidstatus"  >{{$valid}} </span> </p>
                                                    <p class="rfix">Client Name: <span class="fw-bold"> {{$user->firstname }} {{$user->lastname}} </span> </p>
                                                    <p class="rfix">Auction Id: <span class="fw-bold"> {{$bid->idauction}} </span> </p>
                                                    <p class="rfix">Auction Name: <span class="fw-bold"> {{$auction->name}} </span> </p>
                                                    <p class="rfix">Price: <span class="fw-bold"> {{$bid->price}}€ </span> </p>

                                                    <!--view user profile-->
                                                    <div class="d-flex">
                                                        <form action="{{ route('profile', ['username' => $user->username]) }}" method="get">
                                                            <input type="submit" class="modal-btn cf"  value="View User Profile"/>
                                                        </form>
                                                        <form action="{{ route('auction', ['id' => $auction->idauction]) }}" method="get">
                                                            <input type="submit" class="modal-btn cf ms-3"  value="View Auction"/>
                                                        </form>
                                                    <button class="modal-btn modal-hide cl ms-3">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-fader"></div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
