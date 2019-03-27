<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Akmey') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="ui fixed inverted menu">
            <div class="ui container">
                <a class="header item" href="{{ url('/') }}">
                    {{ config('app.name', 'Akmey') }}
                </a>
                <div href="#" class="ui dropdown item">
                    <i class="info icon"></i><i class="dropdown icon"></i>

                    <div class="menu">
                        <a href="/privacy" class="item">{{ __('layout.menu.privacy') }}</a>
                        <a href="/legal" class="item">{{ __('layout.menu.legal') }}</a>
                    </div>
                </div>

                <div class="right menu" id="navbarSupportedContent">
                    <div href="#" class="ui dropdown item">
                        <i class="language icon"></i><i class="dropdown icon"></i>

                        <div class="menu">
                            @foreach (config('app.locales') as $lang => $language)
                                <a href="/language/{{ $lang }}" class="item">{{ $language }}</a>
                            @endforeach
                        </div>
                    </div>
                    <dark-button v-on:change-theme="switchTheme"></dark-button>
                    <!-- Authentication Links -->
                    @guest
                        <a class="item" href="{{ route('login') }}">{{ __('layout.guest.login') }}</a>
                        @if (Route::has('register'))
                            <a class="item" href="{{ route('register') }}">{{ __('layout.guest.register') }}</a>
                        @endif
                    @else
                        <div href="#" class="ui dropdown item">
                            <img class="ui avatar circular image" src="/storage/{{ Auth::user()->profilepic }}"><span>{{ Auth::user()->name }}</span> <i class="dropdown icon"></i>

                            <div class="menu">
                                <a class="item" href="{{ url('/u/'.Auth::user()->name) }}">
                                    <i class="user icon"></i> {{ __('layout.user.profile') }}
                                </a>
                                <a class="item" href="{{ route('dashboard') }}">
                                    <i class="dashboard icon"></i> {{ __('layout.user.dashboard') }}
                                </a>
                                <a class="item" href="{{ route('dashboardsection', ['section' => 'oauth']) }}">
                                    <i class="code icon"></i> {{ __('layout.user.oauth') }}
                                </a>
                                <a class="item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="logout icon"></i> {{ __('layout.user.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="minimargin">
            <noscript>
                <div class="ui container">
                    <div class="ui negative message">
                        <div class="header">
                            {{ __('layout.js._') }}
                        </div>
                        <p>{{ __('layout.js.tooltip') }}</p>
                    </div>
                </div>
                <br/>
            </noscript>
            @yield('content')
        </main>
    </div>
</body>
</html>
