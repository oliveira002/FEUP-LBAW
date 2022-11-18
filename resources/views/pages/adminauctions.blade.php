@extends('layouts.app')
@inject('own', 'App\Http\Controllers\AdminController')



@section('content')
    <link href="{{asset('css/adminusers.css')}}" rel="stylesheet">
    <div class = "cover out3">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf mt-4 mb-4">
                        <div class = "d-flex query mt-4">
                            <p class ="h3 fw-bold"> All Users </p>
                            <div class="search2">
                                <div class = "sbar2">
                                    <form action="{{ route('search') }}" method="get">
                                        <input type="text" id="searchbar2" name="search_query" placeholder="Search a user...">
                                        <i class="fa fa-search"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class = "tableContainer">
                            <table class="table oview mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($auctions as $act)
                                    <div class = "d-flex align-items-center">
                                        <tr>
                                            <th class = "fw-bold">{{$act->idauction}}</th>
                                            <td>
                                                <span class = "ms-2 fw-light">{{$act->name}}</span>
                                            </td>
                                            <td class = "mt-3"></td>
                                            <td>
                                                <a href = "" class = "linkii"> <i class="fa-solid fa-eye"></i></a>
                                                <a class="open-modal fw-bold linkii" data-target="modal-2"> <i class="fa-solid fa-ban"></i> </a>
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
                                    <div id="modal-2" class="modal-window">
                                        <div class = "d-flex">
                                            <h2>Ban Confirmation</h2>
                                            <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> BLOCK </span> the user <span class = "fw-bold"></span> </p>
                                        <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                                        <div class = "d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <input type="submit" form="myform" class="modal-btn cf ms-3"  value="Confirm"/>
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
