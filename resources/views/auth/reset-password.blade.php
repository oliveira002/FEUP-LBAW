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
                    @if($errors->has('email'))
                        <div class="alert alert-danger mb-1.5 mt-1.5">
                            <ul>
                                <li>{{ $errors->first('email') }}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        {{ csrf_field() }}
                        <!-- Token input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="token" type="hidden" name="token"
                                   value="{{ $token }}" required autofocus/>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="recoveryEmail" type="hidden" name="email" required autofocus/>
                        </div>
                        <div class="info">
                            Enter your new password.
                        </div><br>
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
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Reset password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
