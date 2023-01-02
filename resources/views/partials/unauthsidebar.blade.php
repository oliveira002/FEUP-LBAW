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

                <a href="{{route('login')}}"><span class="fa-solid fa-plus mr-3"></span> Create a auction</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-regular fa-star mr-3"></span> Favorite Auctions</a>
            </li>

            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-house-user mr-3"></span> My Auctions</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-coins mr-3"></span> My Bids</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-user mr-3"></span> Profile</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-sack-dollar mr-3"></span> Add Funds</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-magnifying-glass mr-3"></span> Search for Auction</a>
            </li>
            <li>
                <a href="{{route('login')}}"><span class="fa-solid fa-right-from-bracket mr-3"></span> Login</a>
            </li>

        </ul>



    </div>
</nav>
