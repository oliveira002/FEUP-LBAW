@extends('layouts.app')

@push('head')
    <!-- Styles -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <!-- Scripts -->
@endpush

@section('content')

    <section class="loginpage" id="loginpage">
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-95 py-5">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="logoname">
                        <a href="{{route('/')}}"><span>WeBid</span></a>
                    </div>
                    @if($errors->has('wrong_credentials'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('wrong_credentials') }}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus/>
                            <label class="form-label">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                   required/>
                            <label class="form-label">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember"
                                       name="remember" value="{{ old('remember') ? 'checked' : '' }}" />
                                Remember Me
                            </div>
                            <a href="{{ route('recovery') }}">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>

                        <a id="register-link" title="Click to register"
                           href="{{route('register')}}">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
