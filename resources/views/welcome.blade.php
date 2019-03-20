@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark }">
        <h1 class="ui center aligned icon header">
            <i class="key icon"></i>
            <div class="content">
                {{ config('app.name', 'Akmey') }}
                <div class="sub header">{{ __('welcome.slogan') }}</div>
            </div>
        </h1>
        <div class="ui equal width grid">
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="user icon"></i>
                    <div class="content">
                        {{ __('welcome.user.title') }}
                        <div class="sub header">{{ __('welcome.user.slogan') }}</div>
                    </div>
                </h2>
            </div>
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="wrench icon"></i>
                    <div class="content">
                        {{ __('welcome.tools.title') }}
                        <div class="sub header">{{ __('welcome.tools.slogan') }}</div>
                    </div>
                </h2>
            </div>
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="github icon"></i>
                    <div class="content">
                        {{ __('welcome.opensource.title') }}
                        <div class="sub header">{{ __('welcome.opensource.slogan') }}</div>
                    </div>
                </h2>
            </div>
        </div>
        <div class="ui three column centered grid">
            <div class="center aligned column">
                @if (Auth::guest()) <a href="/register" class="ui primary button">{{ __('welcome.cta.register') }}</a>
                @else <a href="/dashboard" class="ui primary button">{{ __('welcome.cta.go') }}</a>
                @endif
                <a href="/doc" class="ui grey button">{{ __('welcome.cta.more') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
