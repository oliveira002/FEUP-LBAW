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
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-5 mb-4"> 
                        <p class ="h2 fw-bold"> My Details </p>
                        <p class ="h4"> Feel free to change any of your details right below! </p>
                    </div>
                    <div class = "forms">
                        <div class = "data ms-3 mb-4">
                            <label for="html" class = "fw-bold">First Name:</label><br>
                            <input type="text" class="formData ps-1" name = "name" value = "{{$user->firstname}}">
                        </div>
                        <div class = "data ms-3 mb-4">
                            <label for="html" class = "fw-bold">Last Name:</label><br>
                            <input type="text" class="formData ps-1" name = "name" value = "{{$user->lastname}}">
                        </div>
                        <div class = "data ms-3 mb-4">
                            <label for="html" class = "fw-bold">Email:</label><br>
                            <input type="text" class="formData ps-1" name = "name" value = "{{$user->email}}">
                        </div>
                        <div class = "data ms-3 mb-4">
                            <label for="html" class = "fw-bold">Phone Number:</label><br>
                            <input type="text" class="formData ps-1" name = "name" value = "{{$user->phonenumber}}">
                        </div>
                    </div>
                    <div>
                        <div class = "botao ps-0 ms-3">
                            <a class = "save text-center" href = "">
                                <button>
                                    Save Changes
                                </button>
                            </a>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
