@extends('layouts.app')

@section('content')
    <div class="contact">
        <h3 class="fw-bold mb-5 mt-5">Contact Us!</h3>
        <form action="">
            <div class="input-box">
                <label for="name">Name:</label>
                <input id="name" type="text" name="name" placeholder="Type your name..." required>
            </div>
            <div class="input-box">
                <label for="name">Email:</label>
                <input id="name" type="text" name="name" placeholder="Type your email..." required>
            </div>
            <div class="input-box">
                <label for="desc">Motive:</label>
                <textarea id="desc" name="desc" placeholder="What do you want to tell us?"></textarea>
            </div>
            <div class="continue-button mb-3">
                <input type="submit" class="continue-button" value="Send"/>
            </div>
        </form>
    </div>
@endsection
