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
                            <p class = "txtt"> You are in the admin panel, here you can administrate the website.</p>
                        </div>
                        <div class = "d-flex mt-4 numbers">
                            <div class = "d-flex boxi">
                                <img class = "fill" src= "/user.png" width="50" height="50">
                                <div class = "ms-2">
                                    <span class = "h5"> Total </span>
                                    <p class = "h5 mb-0"> Costumers </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numUsers}} </p>
                                </div>
                            </div>
                            <div class = "d-flex boxi ms-5">
                                <img class = "fill" src= "/numauc.png" width="50" height="50">
                                <div class = "ms-2">
                                    <span class = "h5"> Total </span>
                                    <p class = "h5 mb-0"> Auctions </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numAuc}} </p>
                                </div>
                            </div>
                            <div class = "d-flex boxi ms-5">
                                <img class = "fill" src= "/numbid.png" width="50" height="50">
                                <div class = "ms-2">
                                    <span class = "h5"> Total</span>
                                    <p class = "h5"> Bids </p>
                                    <p class = "h5 fw-bold mb-0"> {{$numBids}} </p>
                                </div>
                            </div>
                        </div>
                        <p class ="h3 fw-bold mt-4"> Latest Reports </p>
                        <table class="table oview mt-4">
                            <thead>
                              <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Costumer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <div class = "d-flex align-items-center">
                                <tr>
                                    <td>
                                        <span class = "ms-2 fw-bold">1</span>
                                    </td>
                                    <th class = "boxi2" scope="row">
                                        <img src= "/alo.jpg" width="40" height="40">
                                        <span class = "ms-2 fw-light">André Garcia </span>
                                    </th>
                                    <td class = "mt-3">2022-12-10 13:12:11</td>
                                    <td>
                                        <a href = "" class = "linkii"> <i class="fa-solid fa-eye"></i></a>
                                        <a class="open-modal fw-bold linkii" data-target=""> <i class="fa-solid fa-check"></i></a>
                                    </td>
                                </tr>
                            </div>
                            </tbody>
                          </table>
                          <div class = "smore">
                            <a href = "" class = "fw-bold h5"> View All </a>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
