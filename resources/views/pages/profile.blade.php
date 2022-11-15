@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div id="profile">
        <div id="aside">
            <ul>
                <li><a href="">My profile</a></li>
                <li>Wallet</li>
                <li>Bids</li>
                <li>Auctions</li>
                <li>Favourites</li>
                <li>Support</li>
            </ul>
        </div>
        <div id="info-wrapper">
            <a id="edit-info" href="">Edit Information <i class="fa-solid fa-pencil"></i></a>
            <div id="info">
                <div class="card" id="info-card">
                    <div class="card-name">Info</div>

                    <img id="pfp" src="https://via.placeholder.com/50x50" alt="Your profile picture" >

                    <div id="username">{{$user->username}}</div>

                    <div id="name">{{$user->firstname}} {{$user->lastname}}</div><hr>

                    <div id="email">{{$user->email}}</div><hr>

                    <div id="phoneNO">{{$user->phonenumber}}</div><hr>

                    <div id="change-pass"><a href="">Change password</a></div>
                </div>
                <div>
                    <div class="card" id="address-card">
                        <div class="card-name">Address</div>

                        <div id="street-name-text">Street name</div>
                        <div id="street-name-value">{{$user->address}}</div>

                        <div id="additional-info-text">Apt, House no, etc</div>
                        <div id="additional-info-value">{{$user->address}}</div>

                        <div id="country-text">Country</div>
                        <div id="country-value">{{$user->address}}</div>

                        <div id="city-text">City</div>
                        <div id="city-value">{{$user->address}}</div>

                        <div id="zip-text">ZIP</div>
                        <div id="zip-value">{{$user->address}}</div>
                    </div>
                    <div class="card" id="recent-activity-card">
                        <div class="card-name">Recent Activity</div>

                        <div class="activity">
                            <div class="text">Placed a bid of 1000€ on "GTX 1060"</div>
                            <div class="date">15/11 21:05</div>
                        </div>

                        <div class="activity">
                            <div class="text">Created auction "BMW 420d novo"</div>
                            <div class="date">13/11 16:07</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
