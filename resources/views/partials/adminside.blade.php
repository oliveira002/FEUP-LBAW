<div id="side">
    <div class="hi d-flex pt-4 pb-4 wat">
        <div class="lg">
            <img src="/alo.jpg" width="120" height="120">
        </div>
        <div class="nome ms-2 me-2">
            <p class="fw-bold mb-1">Hi,</p>
            <p class="fw-bold mb-0"> Admin</p>
        </div>
    </div>
    <ul class="ps-0 mt-2">
        <li>
            <a href="{{route('admin')}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-user"></i>
                    Dashboard
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('manusers')}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-address-card"></i>
                    Costumers
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('manauctions')}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-house-user"></i>
                    Auctions
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('manbids')}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-coins"></i>
                    Bids
                </button>
            </a>
        </li>
        <li>
            <a href="">
                <button class="fw-bold">
                    <i class="fa-solid fa-question"></i>
                    Reports
                </button>
            </a>
        </li>
        <li>
            <form method="POST" action="{{route('logout')}}">
                {{csrf_field()}}
                <button class="fw-bold">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
