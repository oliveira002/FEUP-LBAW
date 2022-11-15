@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "pattern">
        <div id="profile" class = "d-flex">
            <div id="aside">
                <ul class = "ps-0">
                    <li><a href=""><button>  My profile </button> </a> </li>
                    <hr class ="mt-1 linha">
                    <li><a href=""><button>  Wallet </button> </a> </li>
                    <hr class ="mt-0 linha">
                    <li><a href=""><button>  Bids </button> </a> </li>
                    <hr class ="mt-0 linha">
                    <li><a href=""><button>  Auctions </button> </a> </li>
                    <hr class ="mt-0 linha">
                    <li><a href=""><button>  Favourites </button> </a> </li>
                    <hr class ="mt-0 linha">
                    <li><a href=""><button>  My profile </button> </a> </li>
                    <hr class ="mt-0 linha">
                    <li><a href=""><button>  Support </button> </a> </li>
                </ul>
            </div>
            <div class = "outside d-flex">
                <div class = "guy">
                    <div class = "informations mt-2">
                        <img src="../alo.jpg" width= "150" height= 150">
                    </div>
                    <div class = "usern">
                        <p> {{$user->username}}</p>
                    </div>
                    <div class = "datau ms-1">
                        <label for="html" class = "fw-bold">FIRST NAME*:</label><br>
                        <input type="text" class="formData ps-1" name = "name" value = "{{$user->firstname}} {{$user->lastname}}">
                    </div>
                    <div class = "datau ms-1">
                        <label for="html" class = "fw-bold">EMAIL ADRESS*:</label><br>
                        <input type="text" class="formData ps-1" name = "email" value = "{{$user->email}}">
                    </div>
                    <div class = "datau ms-1">
                        <label for="html" class = "fw-bold">Phone Number:</label><br>
                        <input type="text" class="formData ps-1" name = "firstName" value = "{{$user->phonenumber}}">
                    </div>
                </div>
                <div class = "right">
                    <div class = "address d-flex">
                        <div>
                            <div class = "data ms-1">
                                <label for="html" class = "fw-bold">Street Name</label><br>
                                <input type="text" class="formData ps-1" name = "name" value = "Rua Dr. Roberto Frias">
                            </div>
                            <div class = "data ms-1">
                                <label for="html" class = "fw-bold">Apt, House no, etc</label><br>
                                <input type="text" class="formData ps-1" name = "name" value = "Rua Dr. Roberto Frias">
                            </div>
                        </div>
                        <div>
                            <div class = "data ms-1">
                                <label for="html" class = "fw-bold">Country</label><br>
                                <input type="text" class="formData ps-1" name = "name" value = "Portugal">
                            </div>
                            <div class = "data ms-1">
                                <label for="html" class = "fw-bold">City</label><br>
                                <input type="text" class="formData ps-1" name = "name" value = "Porto">
                            </div>
                        </div>
                    </div>
                    <div class = "activity">
                        <div class = "ms-2 mt-4">
                            <p class = "fw-bold"> Recent Activity </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                            <p> Auction of product X sold @ 2000$ </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
