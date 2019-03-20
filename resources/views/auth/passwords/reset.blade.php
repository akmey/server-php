@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('auth.reset.title') }}</h2>

        <form method="POST" action="{{ route('password.update') }}" class="ui form{{ !empty($errors->all()) ? ' error' : '' }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email" >{{ __('auth.email') }}</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>

            <div class="field">
                <label for="password">{{ __('auth.password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </div>

            <div class="field">
                <label for="password-confirm">{{ __('auth.confirm-password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            @if (!empty($errors->all()))
            <div class="ui error message">
                <div class="header">{{ __('auth.error') }}</div>
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
                {{ __('auth.reset.resetbtn') }}
            </button>
        </form>
    </div>
</div>
@endsection
