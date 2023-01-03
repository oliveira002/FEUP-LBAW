<?php
$user = Auth::user();
?>
@if(Auth::guard('admin')->check())
    @include('partials.adminsidebar')
@elseif(Auth::check())
    @include('partials.authsidebar')
@else
    @include('partials.unauthsidebar')
@endif
<div class="cont">
    <header>


        <a href="{{route('/')}}" id="logo"> WeBid</a>
        <div class="search">
            <div class="sbar">

                @if(Route::currentRouteName() === '/' || Route::currentRouteName() === 'AboutUs' || Route::currentRouteName() === 'FAQs' || Route::currentRouteName() === 'ContactUs')
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" id="searchbar" name="search_query" placeholder="Search anything...">
                        <button class="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
                    </form>

                @else
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" id="searchbar" name="search_query" placeholder="Search anything...">
                        <button class="searchsubmit" type="submit"> <i class="fa fa-search"> </i> </button>
                    </form>
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
                <div class="notif">
                    <button onclick="showNotif()">
                        <i class="fa-solid fa-bell fa-gradient"></i>
                        @if(is_null($notifications))
                            <span class="num-count">0</span>
                        @else
                            <span class="num-count">{{count($notifications)}}</span>
                        @endif
                    </button>
                    @if(Auth::check())
                        @include('partials.notifications')
                    @endif
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
