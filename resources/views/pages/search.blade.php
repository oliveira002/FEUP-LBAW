@extends('layouts.app')

@section('content')
<div class="search s2">
    <div class="sbar sb2">
        <button>
            <input type="text" id="searchbar2" name="search_query" placeholder="Search anything...">
            <a href=""> <i class="fa fa-search"> </i> </a>
        </button>
    </div>
</div>
<div class = "catg d-flex justify-content-center mb-3">
    @foreach($category as $cat)
        <div class = "ms-3 me-3 junto">
            <a href="{{route('categorySearch', ['category' => $cat->idcategory] )}}" class = "d-flex flex-column fic">
                <?php $str = "../images/" . $cat->idcategory .".jpg"?>

                <div class = "bgo d-flex justify-content-center">

                    <img src="{{$str}}" width="70" height="70" alt='Category Image'>
                </div>
                <span class = "fw-bold">{{$cat->name}}</span>
            </a>
        </div>
    @endforeach
</div>
<hr class = "mt-3 mb-4 lina">
<div class = "filtros">
    <form name= "ajax">
        <div class = "ms-5 mt-2">
            <p class = "h4"> Display: </p>
            <div class = "d-flex flex-column">
                <div>
                    <input id = "up" class  type="radio" name= "tempo" value="0" checked>
                    <label for="tempo">Upcoming Items</label>
                </div>
                <div>
                    <input id = "past" class type="radio" name= "tempo" value="1">
                    <label for="tempo">Past Items</label>
                </div>
            </div>
        </div>
        <div class = "ms-5 mt-2">
            <p class = "h4"> Sort by: </p>
            <div class = "d-flex flex-column">
                <div>
                    <input id = "normal" class  type="radio" name= "filter" value="0" checked>
                    <label for="filter">Price</label>
                </div>
                <div>
                    <input id = "sort_pop" class type="radio" name= "filter" value="1">
                    <label for="filter">Most Popular</label>
                </div>
                <div>
                    <input id = "sort_rating" class type="radio" name= "filter" value="2">
                    <label for="filter">Rating</label>
                </div>
            </div>
        </div>
            <div class = "ms-5 mt-4 class =">
                <p class = "h4"> Price Range: </p>
                <div class = "d-flex range">
                    <input id="pricemin" type="number" name="min" value="" min = "0" max = "1000000" placeholder="0">
                    <span class = "h5 ms-2 me-2 mt-1"> to </span>
                    <input id="pricemax" type="number" name="max" value="" min = "0" max = "100000000" placeholder="10000000">
                </div>
            </div>
        <div>

        </div>
        <div>

        </div>
        <div>

        </div>
    </form>
</div>
<div class ="pattern">
    <div class="container-fluid">
        <div>
            <div class = "h4 titt"> {{count($auctions)}} items displayed</div>
            @include('partials.categ')
        </div>
        <div id = "auction" class="d-flex flex-row flex-wrap justify gridd">
            @foreach($auctions as $auct)
                <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                    <div class = "itemauc">
                        <a href="{{route('auction',['id' => $auct->idauction])}}"><img src= "/images/{{$auct->idauction}}/1.jpg" width="287" height="190"></a>
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
