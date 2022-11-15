@extends('layouts.app')

@section('content')

<div class="form-structor" id="login">

</div>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                    class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
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
                   

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name = "password" id="password" class="form-control form-control-lg" required />
                        <label for="password" class="form-label" for="password">Password</label>
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
                    <a class="button button-outline" href="{{ route('register') }}">Register</a>



            </div>
        </div>
    </div>
</section>
@endsection