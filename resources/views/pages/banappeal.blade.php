@extends('layouts.app')

@section('content')
    <div class="contact">
        @if(count($ban_appeals)==0)
            <h3 class="fw-bold mb-5 mt-5">You are Banned!</h3>
            <form action="{{route('submitBanAppeal')}}" method="POST">
                {{ csrf_field() }}
                  <span class="fw-bold">You are unable to browse the website, as well as create auctions and place bids!</span>
                <div class="input-box mt-4">
                    <label for="desc">Request Unban</label>
                    <textarea id="appeal" name="desc" placeholder="Reason why you should be unbanned" required></textarea>
                </div>

                <div class="continue-button mb-3">
                    <button type="submit" class="appeal-button">Send</button>
                </div>
            </form>
        @else
            <h3 class="fw-bold mb-5 mt-5">You have already requested an unban</h3>
            <h3 class="request mt-5">Your Unban Request:</h3>
            <span class="bandesc mb-3">{{$ban_appeals->first()->appealdescription}}</span>
            <div class="d-flex justify-content-center">
                <span class="fw-bold pe-1">Date:</span>
                <span class="date">{{$ban_appeals->first()->appealdate}}</span>
            </div>

            <span class="fw-bold">Please wait while we analyze your request!</span>
            <div class="loading">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        @endif
        <form method="POST" action="{{route('logout')}}" class="reg">
            @csrf
            <button type="submit">
                <i class="fa-solid fa-user-minus"></i>
                <span> Logout </span>
            </button>
        </form>
    </div>
@endsection
