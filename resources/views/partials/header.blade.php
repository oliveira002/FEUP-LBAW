<?php
$user = Auth::user();
?>

<div class="cont">
    <header>
        <a href="{{route('/')}}" id="logo"> WeBid</a>
        <div class="search">
            <div class="sbar">
                @if(Route::currentRouteName() === '/')
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" id="searchbar" name="search_query" placeholder="Search anything...">
                        <a href=""> <i class="fa fa-search"> </i> </a>
                    </form>
                @else
                    <button>
                        <input type="text" id="searchbar" name="search_query" placeholder="Search anything...">
                        <a href=""> <i class="fa fa-search"> </i> </a>
                    </button>
                @endif
            </div>
        </div>
        <div class="auth d-flex">
            @if(Auth::guard('web')->check())
                <a class="balance" href="{{route('balance',['username' =>$user->username])}}">
                    <button>
                        <span>Balance: {{$user->balance}}€</span>
                    </button>
                </a>
                <a class="log" href="{{route('profile',['username' =>$user->username])}}">
                    <button>
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </button>
                </a>
                <form method="POST" action="{{route('logout')}}" class="reg">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-user-minus"></i>
                        <span> Logout </span>
                    </button>
                </form>
            @elseif(Auth::guard('admin')->check())
                <a class="log" href="{{route('admin')}}">
                    <button>
                        <i class="fa-solid fa-user"></i>
                        <span>Admin</span>
                    </button>
                </a>
                <form class="reg" method="POST" action="{{route('logout')}}">
                    {{csrf_field()}}
                    <button>
                        <i class="fa-solid fa-user-minus"></i>
                        <span> Logout </span>
                    </button>
                </form>
            @else
                <a class="log" href="{{route('login')}}">
                    <button>
                        <i class="fa-solid fa-user"></i>
                        <span>Login</span>
                    </button>
                </a>
                <a href="{{route('register')}}" class="reg">
                    <button>
                        <i class="fa-solid fa-user-plus"></i>
                        <span> Register </span>
                    </button>
                </a>
            @endif
        </div>
    </header>
</div>
