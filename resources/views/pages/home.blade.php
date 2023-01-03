@extends('layouts.app')


@section('content')
    <div class ="pattern">


        <div class="container-fluid">
            <div class="d-flex flex-row flex-wrap justify-content-center ">
                <p class = "fw-bold fs-2"> Categories </p>
            </div>
                @foreach($categories->chunk(3) as $chunk)
                    <div class="d-flex flex-row flex-wrap justify-content-center ">
                        @foreach($chunk as $add)
                            <div class="d-flex flex-column p-3">
                                <div class = "itemcateg d-flex justify-content-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)),url('../images/{{$add->idcategory}}.jpg');">

                                    <a href = "{{route('categorySearch',['category' => $add->idcategory])}}" class = "h4 fw-bold"> {{$add->name}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
        </div>
        <div class="container-fluid">
            <div class="d-flex flex-row flex-wrap justify-content-center ">
                <p class = "fw-bold fs-2 mb-0"> Ending Soon! </p>
            </div>
            <div class="d-flex flex-row flex-wrap justify-content-center">
                @foreach($auctions as $auct)
                    <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                        <div class="container-img">
                            <div class = "itemauc">
                                <a href="{{route('auction',['id' => $auct->idauction])}}"><img class= "img-fluid" src= "images/{{$auct->idauction}}/1.jpg" alt='Auction Image'></a>
                                <a href="{{route('auction',['id' => $auct->idauction])}}">
                                    <div class = "prop" >
                                        <p id = "price" class = "fw-bold mb-0 mt-1">{{$auct->currentprice}}€ </p>
                                        <p id = "nome" class = "fw-bold mb-5"> {{$auct->name}} </p>
                                    </div>
                                </a>
                            </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if ($favorites !== null && count($favorites) > 0)
            <div class="container-fluid">
                <div class="d-flex flex-row flex-wrap justify-content-center ">
                    <p class = "fw-bold fs-2 mb-0"><i class="fa-solid fa-bookmark fa-xs"></i> Favorite Auctions </p>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-center">
                    @foreach($favorites as $auct)
                        <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                            <div class="container-img">
                                <div class = "itemauc">
                                    <a href="{{route('auction',['id' => $auct->idauction])}}"><img class= "img-fluid" src= "images/{{$auct->idauction}}/1.jpg" alt='Auction Image'></a>
                                    <a href="{{route('auction',['id' => $auct->idauction])}}">
                                        <div class = "prop" >

                                            <p id = "nome" class = "fw-bold mb-5"> {{$auct->name}} </p>
                                        </div>
                                    </a>
                                </div>
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif





    </div>

@endsection
