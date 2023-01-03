@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="cover out8">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf mt-4 mb-4">
                        <div class="d-flex query mt-4">
                            <p class="h3 fw-bold"> All Ban Appeals </p>
                        </div>
                        <div class="tableContainer">
                            <table class="table oview mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tablecontent">
                                @foreach($appeals as $appeal)
                                    <div class="d-flex align-items-center">
                                        <tr>
                                            <th class="fw-bold">{{$appeal->idbanappeal}}</th>
                                            <?php
                                                $user = \App\Models\User::find($appeal->idclient);
                                            ?>
                                            <td>
                                                <span class=" fw-light">{{$user->username}}</span>
                                            </td>
                                            <td class = "actions ms-2">
                                                <a class="open-modal fw-bold linkii" data-target="modalS-{{$appeal->idbanappeal}}"> <i class="fa-solid fa-eye"></i></a>
                                                <a class="open-modal fw-bold linkii" data-target="modal-{{($appeal->idbanappeal * 2)-1}}"> <i class="fa-solid fa-check"></i> </a>
                                                <a class="open-modal fw-bold linkii" data-target="modal-{{($appeal->idbanappeal  * 2)}}"> <i class="fa-solid fa-xmark"></i> </a>
                                            </td>
                                        </tr>
                                    </div>
                                    <div id="modalS-{{$appeal->idbanappeal}}" class="modal-window">
                                        <div class="d-flex">
                                            <h2>Ban Appeal</h2>
                                            <button class="close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <div class ="d-flex">
                                            <span class ="fw-bold">Date:</span>
                                            <span class="rfix ms-2 mb-2">{{$appeal->appealdate}}</span>
                                        </div>
                                        <p class="rfix">{{$appeal->appealdescription}}</p>
                                        <div class="d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                        </div>
                                    </div>
                                    <div id="modal-{{($appeal->idbanappeal  * 2)-1}}" class="modal-window">
                                        <div class = "d-flex">
                                            <h2>Accept Appeal Confirmation</h2>
                                            <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> ACCEPT </span>  the user's ban appeal <span class = "fw-bold"></span> </p>
                                        <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                                        <div class = "d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <form action="{{route('unban',['id' => $user->idclient, 'idbanappeal' => $appeal->idbanappeal])}}" method="post">
                                                <input type="submit" class="modal-btn cf ms-3"  value="Confirm"/>
                                                @method('put')
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <div id="modal-{{($appeal->idbanappeal  * 2)}}" class="modal-window">
                                        <div class = "d-flex">
                                            <h2>Reject Appeal Confirmation</h2>
                                            <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> REJECT </span>  the user's ban appeal <span class = "fw-bold"></span> </p>
                                        <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                                        <div class = "d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <form action="{{route('rejectAppeal',['id' => $appeal->idbanappeal, 'unban' => 0])}}" method="post">
                                                <input type="submit" class="modal-btn cf ms-3"  value="Confirm"/>
                                                @method('delete')
                                                @csrf
                                            </form>
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
