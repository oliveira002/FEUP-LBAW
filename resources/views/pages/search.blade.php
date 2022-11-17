@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div id = "auction" class="d-flex flex-row flex-wrap justify-content-center">
        @foreach($auctions as $auct)
            <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                <div class = "itemauc">
                    <a href="{{route('auction',['id' => $auct->idauction])}}"><img src= "../alo.jpg" width="287" height="190"></a>
                    <a href="{{route('auction',['id' => $auct->idauction])}}">
                        <div class = "prop" >
                            <p id = "price" class = "fw-bold mb-0 mt-1"> {{$auct->currentprice}}€ </p>
                            <p id = "nome" class = "fw-bold mb-5"> {{$auct->name}} </p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
    </div>
    <hidden id="search_text" value="{{$text_to_default}}"></hidden>
    <script>
        let txt = document.getElementById("search_text");
        let search = document.getElementById("searchbar").value = txt.attributes.value.value;
    </script>

@endsection
