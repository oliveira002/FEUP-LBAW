@if(Request::is('search/2'))
        <?php
        $cat = \App\Models\Category::find(2);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/1'))
        <?php
        $cat = \App\Models\Category::find(1);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/3'))
        <?php
        $cat = \App\Models\Category::find(3);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/4'))
        <?php
        $cat = \App\Models\Category::find(4);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/5'))
        <?php
        $cat = \App\Models\Category::find(5);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/6'))
        <?php
        $cat = \App\Models\Category::find(6);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/7'))
        <?php
        $cat = \App\Models\Category::find(7);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/8'))
        <?php
        $cat = \App\Models\Category::find(8);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@elseif(Request::is('search/9'))
        <?php
        $cat = \App\Models\Category::find(9);
        ?>
    <button class="fw-bold titt2 h5 btncate">
        <div class="d-flex">
            {{$cat->name}}
            <a href="{{route('search')}}" class="ms-2"><i class="fa-solid fa-x"></i></a>
        </div>
    </button>
@endif
