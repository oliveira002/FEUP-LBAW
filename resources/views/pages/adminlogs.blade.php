@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="cover out7">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf mt-4 mb-4">
                        <div class="d-flex query mt-4">
                            <p class="h3 fw-bold"> All Admin Logs </p>
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
                                @foreach($logs as $log)
                                    <div class="d-flex align-items-center">
                                        <tr>
                                            <th class="fw-bold">{{$log->idsyslog}}</th>
                                                <?php
                                                $man = \App\Models\SystemManager::find($log->idsysman);
                                                ?>
                                            <td>
                                                <span class=" fw-light">{{$man->username}}</span>
                                            </td>
                                            <td class = "ms-2">
                                                <a class="open-modal fw-bold linkii ms-3" data-target="modalS-{{$log->idsyslog}}"> <i class="fa-solid fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    </div>
                                    <div id="modalS-{{$log->idsyslog}}" class="modal-window">
                                        <div class="d-flex">
                                            <h2>Admin Log</h2>
                                            <button class="close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <div class ="d-flex">
                                            <span class ="fw-bold">Date:</span>
                                            <span class="rfix ms-2 mb-2">{{$log->logdate}}</span>
                                        </div>
                                        <p class="rfix">{{$log->logdescription}}</p>
                                        <div class="d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
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
