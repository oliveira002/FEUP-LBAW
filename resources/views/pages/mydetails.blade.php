@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out2">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class = "outside">
                @if($errors->has('error'))
                    <div class="mb-0 mt-2 alert alert-danger">
                        <ul class = "ps-0">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-4 mb-4">
                        <p class ="h2 fw-bold"> My Details </p>
                        <p class ="h4"> Feel free to change any of your details right below! </p>
                    </div>
                    <form method = "POST">
                        {{ csrf_field() }}
                        @method('PUT')
                    <div class = "forms d-flex">
                        <div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">First Name:</label>
                                <input type="text" class="" name = "firstname" value = "{{$user->firstname}}">
                            </div>
                            <div class = "input-box ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Last Name:</label>
                                <input type="text" class="" name = "lastname" value = "{{$user->lastname}}">
                            </div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Email:</label>
                                <input type="text" class="" name = "email" value = "{{$user->email}}">
                            </div>
                        </div>
                        <div class = "ms-5">
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Username:</label>
                                <input type="text" class="" name = "username" value = "{{$user->username}}">
                            </div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Adress:</label>
                                <input type="text" class="" name = "address" value = "{{$user->address}}">
                            </div>
                            <div class = "input-box  ms-3 mb-4">
                                <label for="html" class = "fw-bold ms-0">Phone Number:</label>
                                <input type="text" class="" name = "phonenumber" value = "{{$user->phonenumber}}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="continue-button botao ps-0 ms-3 mb-4">
                            <input type="submit" class = "continue-button" value="Save Changes"/>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
