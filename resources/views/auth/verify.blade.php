@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment">
        <h2 class="ui center aligned header">{{ __('Verify Your Email Address') }}</h2>

        <div class="card-body">
            @if (session('resent'))
                <div class="ui success message" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
        </div>
    </div>
</div>
@endsection
