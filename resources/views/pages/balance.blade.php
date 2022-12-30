@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class="cover out3">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div>
                <div class="spec d-flex flex-column ps-3 pe-3" id="balance-container">
                    <div class="stuf ms-3 mt-4 mb-4">
                        <div class="stuf ms-3 mt-5 mb-4">
                            <p class="h1 fw-bold">My Wallet</p>

                        </div>
                        <div class="stuf ms-3 mt-5 mb-4">
                            <p class="h4 fw-bold"> Balance: </p>
                            <p class="h4 fw-bold">  {{$user->balance}}€ </p>

                        </div>
                        <div class="stuf ms-3 mt-5 mb-4">
                            <p class="h4 fw-bold"> Add funds: </p>
                            <form action="{{route('addFunds',['username' =>$user->username])}}" method="post">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <input type="float" class="form-control" placeholder="Amount" aria-label="Amount"
                                           aria-describedby="button-addon2" name="amount" min="0">
                                </div>
                                <ul class="payment-selection">
                                    <div class="opt">
                                        <input type="radio" id="paypal" name="deposit-type" value="Paypal" checked>
                                        <label for="paypal"><i class="fa-brands fa-paypal"></i> Paypal</label>
                                    </div>
                                    <div class="opt">
                                        <input type="radio" id="mbway" name="deposit-type" value="Mbway">
                                        <label for="mbway"><img src="/mbway-seeklogo.com.svg" alt="Mbway" width="50" height="25"></label>
                                    </div>
                                    <div class="opt">
                                        <input type="radio" id="bank-transfer" name="deposit-type" value="Bank Transfer">
                                        <label for="bank-transfer"><i class="fa-solid fa-university"></i> Bank Transfer</label>
                                    </div>
                                    <div class="opt">
                                        <input type="radio" id="crypto" name="deposit-type" value="Crypto">
                                        <label for="crypto"><i class="fa-brands fa-bitcoin"></i> Crypto</label>
                                    </div>
                                    <div class="opt">
                                    <input type="radio" id="credit-card" name="deposit-type" value="Credit Card">
                                    <label for="credit-card"><i class="fa-brands fa-cc-visa"></i> Credit Card</label>
                                    </div>

                                </ul>
                                <button class="btn btn-primary"> Add Funds</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
