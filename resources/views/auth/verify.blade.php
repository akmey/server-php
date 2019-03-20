@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('auth.emailcheck.title') }}</h2>

        <div class="card-body">
            @if (session('resent'))
                <div class="ui success message" role="alert">
                    {{ __('auth.emailcheck.sent') }}
                </div>
            @endif

            {{ __('auth.emailcheck.one') }}
            @lang('auth.emailcheck.two._', ['link' => '<a href="' . route('verification.resend') . '">' . __('auth.emailcheck.two.link') . '</a>']);
        </div>
    </div>
</div>
@endsection
