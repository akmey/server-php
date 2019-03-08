@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('Reset Password') }}</h2>
        @if (session('status'))
            <div class="ui success message" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="ui form{{ $errors->has('email') ? ' error' : '' }}">
            @csrf

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            @if ($errors->has('email'))
                <div class="ui error message" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
            <button type="submit" class="ui primary button">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
    </div>
</div>
@endsection
