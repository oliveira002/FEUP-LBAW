<div id="side">
    <div class="hi d-flex pt-4 pb-4">
        <div class="lg">
            <img src= "/alo.jpg" width="120" height="120">
        </div>
        <div class="nome ms-2 me-2">
            <p class = "fw-bold mb-1">Hi,</p>
            <p class = "fw-bold mb-0"> Admin</p>
        </div>
    </div>
    <ul class = "ps-0 mt-2">
        <li>
            <a href = "{{route('profile')}}"><button class = "fw-bold">
                    <i class="fa-solid fa-user"></i>
                    Dashboard
                </button> </a>
        </li>
        <li>
            <a href="{{route('details')}}"><button class = "fw-bold">
                    <i class="fa-solid fa-address-card"></i>
                    Costumers
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('balance')}}"><button class = "fw-bold">
                    <i class="fa-solid fa-wallet"></i>
                    Auctions
                </button>
            </a>
        </li>
        <li>
            <a href="{{route('mybids')}}"><button class = "fw-bold">
                    <i class="fa-solid fa-coins"></i>
                    Bids</button>
            </a>
        </li>
        <li>
            <a href="{{route('mybids')}}"><button class = "fw-bold">
                    <i class="fa-solid fa-coins"></i>
                    Reports</button>
            </a>
        </li>
        <li>
            <a href="{{route('logout')}}""><button class = "fw-bold">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout</button>
            </a>
        </li>
    </ul>
</div>            