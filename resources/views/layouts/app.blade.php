<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Akmey') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="ui fixed inverted menu">
            <div class="ui container">
                <a class="header item" href="{{ url('/') }}">
                    {{ config('app.name', 'Akmey') }}
                </a>
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->

                <div class="right menu" id="navbarSupportedContent">
                    {{--<!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">--}}
                        <!-- Authentication Links -->
                        @guest
                            <a class="item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="item" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <div href="#" class="ui dropdown item">
                                {{ Auth::user()->name }} <i class="dropdown icon"></i>

                                <div class="menu">
                                    <a class="item" href="{{ route('dashboard') }}">
                                        Dashboard
                                    </a>
                                    <a class="item" href="{{ route('dashboardapps') }}">
                                        OAuth Apps
                                    </a>
                                    <a class="item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    {{-- </ul> --}}
                </div>
            </div>
        </nav>

        <main class="minimargin">
            <noscript>
                <div class="ui container">
                    <div class="ui negative message">
                        <div class="header">
                            Akmey works with JS.
                        </div>
                        <p>We understand that JavaScript may annoy you, but certain parts of Akmey needs JS to work. However, we make the possible to make Akmey accessible without JS. Try to activate it if you have problems</p>
                    </div>
                </div>
                <br/>
            </noscript>
            @yield('content')
        </main>
    </div>
</body>
</html>
