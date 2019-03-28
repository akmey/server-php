@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('auth.register') }}</h2>

        <div class="ui message">
            <p>@lang('auth.policy._', ['link' => '<a href="/privacy?register=1">' . __('auth.policy.link') . '</a>'])</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="ui form{{ !empty($errors->all()) ? ' error' : '' }}">
            @csrf

            <div class="field{{ $errors->has('name') ? ' error' : '' }}">
                <label for="name">{{ __('auth.username') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="username">
            </div>

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">{{ __('auth.email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
            </div>

            <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                <label for="password">{{ __('auth.password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
            </div>

            <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                <label for="password-confirm">{{ __('auth.confirm-password') }}</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
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
                {{ __('auth.register') }}
            </button>
        </form>
    </div>
</div>
@endsection
