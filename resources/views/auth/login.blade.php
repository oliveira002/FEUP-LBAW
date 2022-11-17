@extends('layouts.app')

@push('head')
    <!-- Styles -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/login.js') }}" defer></script>
@endpush

@section('content')

    <section class="loginpage" id = "loginpage" >
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-95 py-5">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="logoname">
                    <span>
                        WeBid
                    </span>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus />
                            <label class="form-label" >Email address</label>

                            @if ($errors->has('email'))
                                <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                            @endif
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name = "password" id="password" class="form-control form-control-lg" required />
                            <label  class="form-label" >Password</label>
                            @if ($errors->has('password'))
                                <span class="error">
                            {{ $errors->first('password') }}
                        </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">

                                <input class = "form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember Me

                            </div>
                            <a href="#!">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>

                        <a id="register-link" title="Click to do something"
                           href="#" onclick="hideDiv();return false;">Register</a>
                    </form>



                </div>
            </div>
        </div>
    </section>

    <section class="registerpage" id = "registerpage">
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-95 py-5">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="logoname">
                    <span>
                        WeBid
                    </span>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="name" class="form-control form-control-lg" value="{{ old('name') }}" required autofocus />
                            <label class="form-label" for="name">Username</label>
                            @if ($errors->has('username'))
                                <span class="error">
                            {{ $errors->first('username') }}
                        </span>
                            @endif
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                         <input class="form-control form-control-lg" id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus />
                            <label class="form-label" for="form1Example13">Email address</label>

                            @if ($errors->has('email'))
                                <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                            @endif
                        </div>

                        <!-- First Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name = "firstname" id="first_name" class="form-control form-control-lg" value="{{ old('first_name') }}" required autofocus />
                            <label for="first_name" class="form-label">First Name</label>
                            @if ($errors->has('firstname'))
                                <span class="error">
                            {{ $errors->first('firstname') }}
                        </span>
                            @endif
                        </div>

                        <!-- Last Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name = "lastname" id="last_name" class="form-control form-control-lg" value="{{ old('last_name') }}" required autofocus />
                            <label for="last_name" class="form-label">Last Name</label>
                            @if ($errors->has('lastname'))
                                <span class="error">
                            {{ $errors->first('lastname') }}
                        </span>
                            @endif
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name = "password" id="password" class="form-control form-control-lg" required />
                            <label for="password" class="form-label">Password</label>
                            @if ($errors->has('password'))
                                <span class="error">
                            {{ $errors->first('password') }}
                        </span>
                            @endif
                        </div>

                        <!-- Password confirmation input -->
                        <div class="form-outline mb-4">
                            <input type="password" name = "password_confirmation" id="password_confirmation" class="form-control form-control-lg" required />
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            @if ($errors->has('password_confirmation'))
                                <span class="error">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                        <a id="login-link"  title="hide register form"
                           href="#" onclick="hideDiv();return false;">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
