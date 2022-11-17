@extends('layouts.app')

@section('content')
<div class = "catg d-flex justify-content-center mb-3">
    @foreach($category as $cat)
        <div class = "ms-3 me-3 junto">
            <a href="" class = "d-flex flex-column fic">
                <?php $str = "../catsearch/" . $cat->idcategory .".png"?>

                <div class = "bgo d-flex justify-content-center">

                    <img src="{{$str}}" width="50" height="50">
                </div>
                <span class = "fw-bold">{{$cat->name}}</span>
            </a>
        </div>
    @endforeach
</div>
<hr class = "mt-3 mb-4 lina">
<div class = "filtros">
    <div class = "ms-5 mt-2">
        <p class = "h3"> Sort By: </p>
        <div class = "d-flex flex-column">
            <div>
                <input class  type="radio" name= "filter" value="filter" checked>
                <label for="filter">Chosen for you (Default)</label>
            </div>
            <div>
                <input class type="radio" name= "filter" value="filter">
                <label for="filter">Most Popular</label>
            </div>
            <div>
                <input class type="radio" name= "filter" value="filter">
                <label for="filter">Rating</label>
            </div>
        </div>
    </div>
        <div class = "ms-5 mt-4 class =">
            <p class = "h3"> Price Range: </p>
            <div>
                <div class ="d-flex">
                    <button class="preco fw-bold me-2">
                        <10€
                    </button>
                    <button class="preco fw-bold me-2" >
                        <50€
                    </button>
                    <button class="preco fw-bold me-2" >
                        <100€
                    </button>
                    <button class="preco fw-bold me-2" >
                        >100€
                    </button>
                </div>
            </div>
        </div>
    <div>

    </div>
    <div>

    </div>
    <div>

    </div>
</div>
<div class ="pattern">
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
