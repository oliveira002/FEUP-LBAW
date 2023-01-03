@extends('layouts.app')

@section('content')
    <div class="contact">
        @if(false)
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
            //show your appeal

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
