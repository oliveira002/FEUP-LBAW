@extends('layouts.app')

@section('content')
    <div class="contact">

        @if(count($ban_appeals)==0)
        <h3 class="fw-bold mb-5 mt-5">You are Banned!</h3>
        <form action="">
              <span class="fw-bold">You are unable to browse the website, as well as create auctions and place bids!</span>
            <div class="input-box mt-4">
                <label for="desc">Request Unban</label>
                <textarea id="" name="desc" placeholder="Reason why you should be unbanned"></textarea>
            </div>

            <div class="continue-button mb-3">
                <input type="submit" class="continue-button" value="Send"/>
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

            <span class="fw-bold">Waiting for a response from admin</span>
            <div class="loading">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        @endif
    </div>
@endsection
