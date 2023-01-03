@extends('layouts.app')

@section('content')
    <section class="registerpage" id="registerpage">
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

                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="name" class="form-control form-control-lg"
                                   value="{{ old('username') }}" required autofocus maxlength="30"/>
                            <label class="form-label" for="name">Username</label>
                            @if ($errors->has('username'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('username') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus maxlength="50"/>
                            <label class="form-label" for="form1Example13">Email address</label>

                            @if ($errors->has('email'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('email') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- First Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="firstname" id="first_name" class="form-control form-control-lg"
                                   value="{{ old('firstname') }}" required autofocus maxlength="30"/>
                            <label for="first_name" class="form-label">First Name</label>
                            @if ($errors->has('firstname'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('firstname') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Last Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="lastname" id="last_name" class="form-control form-control-lg"
                                   value="{{ old('lastname') }}" required autofocus maxlength="30"/>
                            <label for="last_name" class="form-label">Last Name</label>
                            @if ($errors->has('lastname'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('lastname') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                   required minlength="8"/>
                            <label for="password" class="form-label">Password</label>
                            <div>Password needs to have at least 8 characters, an uppercase and lowercase letter, a special character and a digit.</div>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('password') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!-- Password confirmation input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control form-control-lg" required minlength="8"/>
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            @if ($errors->has('password_confirmation'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li>{{ $errors->first('password_confirmation') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                        <a id="login-link" title="Click to login"
                           href="{{route('login')}}">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
