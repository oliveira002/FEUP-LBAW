@extends('layouts.app')

@section('content')
    <link href="{{asset('css/adminusers.css')}}" rel="stylesheet">
    <div class = "cover out2">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf mt-4 mb-4">
                        <div class = "d-flex query mt-4">
                            <p class ="h3 fw-bold"> All Bids </p>
                            <div class="search2">
                                <div class = "sbar2">
                                    <form action="{{ route('search') }}" method="get">
                                        <input type="text" id="searchbar2" name="search_query" placeholder="Search a bid...">
                                        <i class="fa fa-search"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class = "tableContainer">
                            <table class="table oview mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">IdBid</th>
                                    <th scope="col">ClientName</th>
                                    <th scope="col">IdAuction</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bids as $bid)
                                        <?php
                                            $user = \App\Models\User::find($bid->idclient);
                                        ?>
                                    <div class = "d-flex align-items-center">
                                        <tr>
                                            <th class = "fw-bold">{{$bid->idbid}}</th>
                                            <td>
                                                <span class = " fw-light">{{$user->firstname }} {{$user->lastname}}</span>
                                            </td>
                                            <td class = "mt-3">
                                                {{$bid->idauction}}
                                                <img src="{{asset('/alo.jpg')}}" class = "arrow" width="20" height="20">
                                            </td>
                                            <td class = "mt-3">{{$bid->price}}€</td>
                                            <td>
                                                <a class="open-modal fw-bold linkii" data-target="modal-2"> <i class="fa-solid fa-eye"></i></a>
                                                <a class="open-modal fw-bold linkii" data-target="modal-1"> <i class="fa-solid fa-trash"></i> </a>
                                            </td>

                                        </tr>
                                    </div>
                                        <div id="modal-1" class="modal-window">
                                            <div class = "d-flex">
                                                <h2>Ban Confirmation</h2>
                                                <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                            </div>
                                            <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> BAN </span> the user <span class = "fw-bold"> </span> </p>
                                            <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                                            <div class = "d-flex">
                                                <button class="modal-btn modal-hide cl">Close</button>
                                                <input type="submit" form="myform" class="modal-btn cf ms-3"  value="Confirm"/>
                                            </div>
                                        </div>
                                        <!bid information modal>
                                        <div id="modal-2" class="modal-window">

                                            <div class = "d-flex">
                                                <h2>Bid Infomation</h2>
                                                <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                            </div>
                                            <div class = "d-flex">
                                                <div class = "d-flex flex-column">
                                                    <p class = "rfix">Bid Id: <span class = "fw-bold"> {{$bid->idbid}} </span> </p>
                                                    <p class = "rfix">Bid Date: <span class = "fw-bold"> {{$bid->biddate}} </span> </p>
                                                    <p class = "rfix">Is Bid Valid? <span class = "fw-bold"> {{$bid->isvalid}} </span> </p>
                                                    <p class = "rfix">Client Name: <span class = "fw-bold"> {{$user->firstname }} {{$user->lastname}} </span> </p>
                                                    <p class = "rfix">Auction Id: <span class = "fw-bold"> {{$bid->idauction}} </span> </p>
                                                    <p class = "rfix">Price: <span class = "fw-bold"> {{$bid->price}}€ </span> </p>

                                                    <!--view user profile-->
                                                    <a href="" class = "">View User Profile</a>
                                                    <button class="modal-btn modal-hide cl">Close</button>
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
