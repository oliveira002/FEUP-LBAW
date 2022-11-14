@extends('layouts.app')

@section('content')
<div class="form-group" id = "login">
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <i class="fa-sharp fa-solid fa-key-skeleton"></i> 
        <label for="email"><i class="fa-solid fa-envelope"></i>   E-mail</label>
        
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="error">
            {{ $errors->first('email') }}
            </span>
        @endif
        <i class="fa-solid fa-envelope"></i>
        <i class="fa-thin fa-key-skeleton"></i>
        <label for="password" ><i class="fa-solid fa-lock"></i> Password</label>
        <input id="password" type="password" name="password" required>
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif

        <label>
            <input type="checkbox" id = "remember" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>

        <button type="submit">
            Login
        </button>
        <a class="button button-outline" href="{{ route('register') }}">Register</a>
    
    </form>
</div>
@endsection
