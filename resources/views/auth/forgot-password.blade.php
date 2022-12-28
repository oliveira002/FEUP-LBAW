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
                    <div class="info">
                        Enter the email associated with the account you want to recover the password. If it matches any on our systems you will receive an email with further instructions.
                    </div><br>
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus/>
                            <label class="form-label">Email address</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Send Recovery Link</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
