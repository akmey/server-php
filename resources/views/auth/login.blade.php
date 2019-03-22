@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('auth.login') }}</h2>

        <form method="POST" action="{{ route('login') }}" class="ui form{{ !empty($errors->all()) ? ' error' : '' }}">
            @csrf

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">{{ __('auth.email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                {{-- @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif --}}
            </div>

            <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                <label for="password">{{ __('auth.password') }}</label>
                <input id="password" type="password" name="password" required>

                {{-- @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif --}}
            </div>

            <div class="field">
                <div class="ui checkbox">
                    <input class="hidden" tabindex="0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked=""' : '' }}>

                    <label for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            @if (!empty($errors->all()))
                <div class="ui error message">
                    <div class="header">Please check these errors and retry :</div>
                    <div class="content">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <button type="submit" class="ui primary button">
                {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
                <a class="ui button" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </div>
</div>
@endsection
