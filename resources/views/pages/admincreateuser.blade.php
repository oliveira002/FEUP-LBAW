@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="page" id="create-user">
        <div class="adminreg d-flex">
            <div class="d-flex outside ms-5 me-5 p-3" id="container-newUser">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf ms-3 mt-4 mb-4">
                        <p class="h2 fw-bold"> Create a new User <i class="h3 fa-solid fa-user-plus"></i></p>
                        <p class="h4"> Specify your details right below! </p>
                    </div>
                    @if ($errors->has('username'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('username') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('email') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('firstname'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('firstname') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('lastname'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('lastname') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('password') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('password_confirmation'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('password_confirmation') }}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('admregister')}}">
                        {{ csrf_field() }}
                        <div class="forms d-flex">
                            <div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="firstname" class="fw-bold ms-0">First Name:</label>
                                    <input id="firstname" type="text" class="" name="firstname" value="" required>
                                </div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="lastname" class="fw-bold ms-0">Last Name:</label>
                                    <input id="lastname" type="text" class="" name="lastname" value="" required>
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="email" class="fw-bold ms-0">Email:</label>
                                    <input id="email" type="text" class="" name="email" value="" required>
                                </div>
                            </div>
                            <div class="ms-5">
                                <div class="input-box  ms-3 mb-3">
                                    <label for="username" class="fw-bold ms-0">Username:</label>
                                    <input id="username" type="text" class="" name="username" value="" required>
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="password" class="fw-bold ms-0">Password:</label>
                                    <input id="password" type="text" class="" name="password" value="" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="continue-button botao ps-0 ms-3 mb-2">
                                <input type="submit" class="continue-button" value="Create User"/>
                            </div>
                        </div>
                    </form>
                    <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
