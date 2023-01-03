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

                <a href="{{route('admin')}}"><span class="fa-solid fa-user mr-3"></span> Dashboard</a>
            </li>
            <li>
                <a href="{{route('sellreports')}}"><span class="fa-solid fa-coins mr-3"></span> See Seller Reports</a>
            </li>
            <li>
                <a href="{{route('auctionreports')}}"><span class="fa-solid fa-coins mr-3"></span> See Auction Reports</a>
            </li>
            <li>
                <a href="{{route('adminlogs')}}"><span class="fa-solid fa-user mr-3"></span> Check Logs</a>
            </li>
            <li>
                <a href="{{route('banappeals')}}"><span class="fa-solid fa-person-praying mr-3"></span> See Ban Appeals</a>
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
