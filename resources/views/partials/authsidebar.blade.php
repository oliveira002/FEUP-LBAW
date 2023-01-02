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

                <a href="{{route('createAuction')}}"><span class="fa-solid fa-plus mr-3"></span> Create a auction</a>
            </li>
            <li>
                <a href="#"><span class="fa-regular fa-star mr-3"></span> Favorite Auctions</a>
            </li>
            <li>
                <a href="{{route('myauctions',['username' =>$user->username])}}"><span class="fa-solid fa-house-user mr-3"></span> My Auctions</a>
            </li>
            <li>
                <a href="{{route('mybids',['username' =>$user->username])}}"><span class="fa-solid fa-coins mr-3"></span> My Bids</a>
            </li>
            <li>
                <a href="{{route('profile',['username' =>$user->username])}}"><span class="fa-solid fa-user mr-3"></span> Profile</a>
            </li>
            <li>
                <a href="{{route('addFunds',['username' =>$user->username])}}"><span class="fa-solid fa-sack-dollar mr-3"></span> Add Funds</a>
            </li>
            <li>
                <a href="{{route('search')}}"><span class="fa-solid fa-magnifying-glass mr-3"></span> Search for Auction</a>
            </li>

            <li>
                <form method="POST" action="{{route('logout')}}" class="reg">
                    @csrf
                    <button type="submit" id="logoutbt"><span class="fa-solid fa-right-from-bracket mr-3"></span> Logout</button>
                </form>
            </li>

        </ul>



    </div>
</nav>
