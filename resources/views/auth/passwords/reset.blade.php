@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('Reset Password') }}</h2>

        <form method="POST" action="{{ route('password.update') }}" class="ui form{{ !empty($errors->all()) ? ' error' : '' }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email" >{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>

            <div class="field">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </div>

            <div class="field">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>
</div>
@endsection
