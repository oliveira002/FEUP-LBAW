@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover">
        <div class="prof d-flex">
            <div id="aside">
                <div class="hi d-flex pt-4 pb-4">
                    <div class="lg">
                        <img src= "/alo.jpg" width="120" height="120">
                    </div>
                    <div class="nome ms-2">
                        <p class = "fw-bold mb-1">Hi,</p>
                        <p class = "fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>

                    </div>
                </div>
                <ul class = "ps-0 mt-2">
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-user"></i>
                                Account Overview
                            </button> </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-address-card"></i>
                                My Details
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-wallet"></i>
                                My Wallet
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-coins"></i>
                                My Bids</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-house-user"></i>
                                My Auctions</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-star"></i>
                                Favourites</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-question"></i>
                                Support</button>
                        </a>
                    </li>
                    <li>
                        <a href=""><button class = "fw-bold">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="spec d-flex flex-column ps-3 pe-3" id="balance-container">
                    <div class = "stuf ms-3 mt-5 mb-4">
                        <div class = "stuf ms-3 mt-5 mb-4">
                            <p class = "h1 fw-bold">My Wallet</p>

                        </div>
                        <div class = "stuf ms-3 mt-5 mb-4">
                            <p class ="h4 fw-bold"> Balance: </p>
                            <p class ="h4 fw-bold">  {{$user->balance}}€ </p>

                        </div>
                        <div class = "stuf ms-3 mt-5 mb-4">
                            <p class ="h4 fw-bold"> Add funds: </p>
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="button-addon2" name="amount" min="0">

                                </div>
                                <ul class="payment-selection">
                                    <input type="radio" id="paypall" name="deposit-type" value="Paypall">
                                    <label for="paypall"><i class="fa-brands fa-paypal"></i> Paypall</label>
                                    <input type="radio" id="mbway" name="deposit-type" value="Mbway">
                                    <label for="mbway"><img src= "/mbway-seeklogo.com.svg" alt="Mbway" width="50" height="25"></label>

                                    <input type="radio" id="bank-transfer" name="deposit-type" value="Bank Transfer">
                                    <label for="bank-transfer"><i class="fa-solid fa-university"></i> Bank Transfer</label>
                                    <input type="radio" id="crypto" name="deposit-type" value="Crypto">
                                    <label for="crypto"><i class="fa-brands fa-bitcoin"></i> Crypto</label>
                                    <input type="radio" id="credit-card" name="deposit-type" value="Credit Card">
                                    <label for="credit-card"><i class="fa-brands fa-cc-visa"></i> Credit Card</label>

                                </ul>
                                <button class = "btn btn-primary"> Add Funds </button>


                            </form>

                        </div>
                        <!-- Deposit type: PAYPAL; MBWAY; BANK TRANSFER; CRYPTO; CREDIT CARD -->




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
