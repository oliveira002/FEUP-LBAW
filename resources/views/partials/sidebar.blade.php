<div id="aside">
    <div class="hi d-flex pt-4 pb-4">
        <div class="lg">
            <?php
            if (file_exists('images/users/' . $user->idclient . '.jpg')) {
                $path = '/images/users/' . $user->idclient . '.jpg';
            } else {
                $path = "/images/users/def.png";
            }
            ?>
            <img src="{{$path}}" width="120" height="120" alt='User Image'>
        </div>
        <div class="nome ms-2 me-2">
            <p class="fw-bold mb-1">Hi,</p>
            <p class="fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>
        </div>
    </div>
    <ul class="ps-0 mt-2">
        <li>
            <a href="{{route('profile',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-user"></i>
                    Account Overview
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('details',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-address-card"></i>
                    My Details
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('balance',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-wallet"></i>
                    My Wallet
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('mybids',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-coins"></i>
                    My Bids
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('myauctions',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-house-user"></i>
                    My Auctions
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('myfav',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-star"></i>
                    My Favourites
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('mywins',['username' =>$user->username])}}">
                <button class="fw-bold">
                    <i class="fa-solid fa-crown"></i>
                    My Winnings
                </button>
            </a>
        </li>
        <li>
            <a href="">
                <button class="fw-bold">
                    <i class="fa-solid fa-question"></i>
                    Support
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
