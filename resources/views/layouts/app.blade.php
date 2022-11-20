<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel = "icon" href ="/logo.png">
      <!-- Styles -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
                           integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="{{ asset('css/def.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auction.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/221bee115b.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/search.js') }}></script>
    <script type="text/javascript" src={{ asset('js/login.js') }}></script>
    <script type="text/javascript" src={{ asset('js/popup.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/countdown.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/createauc.js') }} defer></script>
    <script type="text/javascript" src={{ asset('js/bid.js') }} defer></script>
</head>
<body>
<main>
    @if(Route::currentRouteName() === 'login')

    @elseif (Route::currentRouteName() === 'profile' || Route::currentRouteName() === 'myauctions' || Route::currentRouteName() === 'balance' || Route::currentRouteName() === 'mybids' || Route::currentRouteName() === 'details' || Route::currentRouteName() === 'favourites' || Route::currentRouteName() === 'support' || Route::currentRouteName() === 'editusers')

        @include('partials.profheader')
    @elseif(Route::currentRouteName() === 'admin' || Route::currentRouteName() === 'manusers' || Route::currentRouteName() === 'manbids' || Route::currentRouteName() === 'manauctions' || Route::currentRouteName() === 'createuser')
        @include('partials.adminheader')
    @else
        @include('partials.header')
    @endif


    <section id="content">
        @yield('content')
    </section>
    @include('partials.footer')
</main>
</body>
</html>
