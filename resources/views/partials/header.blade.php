<?php
$user = Auth::user();
?>
<nav id="sidebar" class="active">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-secondary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>

    <div class="p-4">
        <h1><a href="{{route('/')}}" class="logo">WeBid</a></h1>
  <ul class="list-unstyled components mb-3">
    <li>
      <a href="#"><span class="fa-solid fa-plus mr-3"></span> Create a auction</a>
    </li>
    <li>
        <a href="#"><span class="fa-regular fa-star mr-3"></span> Favorite Auctions</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-coins mr-3"></span> My Bids</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-user mr-3"></span> Profile</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-sack-dollar mr-3"></span> Add Funds</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-magnifying-glass mr-3"></span> Search for Auction</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-ban mr-3"></span> Report a user</a>
    </li>
    <li>
        <a href="#"><span class="fa-solid fa-right-from-bracket mr-3"></span> Logout</a>
    </li>

  </ul>



</div>
</nav>
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
                <div class="notif" onclick="showNotif()">
                    <button>
                        <i class="fa-solid fa-bell"></i>
                    </button>
                </div>
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
