@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="cover out6">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf mt-4 mb-4">
                        <div class="d-flex query mt-4">
                            <p class="h3 fw-bold"> All Auction Reports </p>
                        </div>
                        <div class="tableContainer">
                            <table class="table oview mt-4">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Reporter</th>
                                    <th scope="col">Auction</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tablecontent">
                                @foreach($reports as $rep)
                                    <div class="d-flex align-items-center">
                                        <tr>
                                            <th class="fw-bold">{{$rep->idreport}}</th>
                                                <?php
                                                $reporter = \App\Models\User::find($rep->idreporter);
                                                $auction = \App\Models\Auction::find($rep->idauction);
                                                $reporterFull = $reporter->firstname . ' ' . $reporter->lastname;
                                                $st = "Solved";
                                                if(!$rep->issolved) {
                                                    $st = "Unsolved";
                                                }
                                                ?>
                                            <td>
                                                <span class=" fw-light">{{$reporterFull}}</span>
                                            </td>
                                            <td class="mt-3"><span class="fw-light">{{$auction->name}}</span></td>
                                            <td class="mt-3"><span class="fw-light">{{$st}}</span></td>
                                            <td class = "ms-2">
                                                <a class="open-modal fw-bold linkii ms-3" data-target="modalS-{{$rep->idreport}}"> <i class="fa-solid fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    </div>
                                    <div id="modalS-{{($rep->idreport)}}" class="modal-window">
                                        <div class="d-flex">
                                            <h2>Motive</h2>
                                            <button class="close modal-hide"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <div class ="d-flex">
                                            <span class ="fw-bold">Date:</span>
                                            <span class="rfix ms-2 mb-2">{{$rep->reportdate}}</span>
                                        </div>
                                        <p class="rfix">{{($rep->description)}}</p>
                                        <div class="d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <form action="{{ route('changeStatus2',['id' => $rep->idreport])}}" method="post">
                                                @method('put')
                                                @if($rep->issolved)
                                                    <input class="modal-btn cf ms-3 red" type="submit" value="Mark Unsolved"/>
                                                @else
                                                    <input class="modal-btn cf ms-3" type="submit" value="Mark Solved"/>
                                                @endif
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
