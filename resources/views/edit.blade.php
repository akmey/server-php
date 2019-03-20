@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('dashboard.edit.title', ['title' => $key->comment]) }}</h2>

        @if($status)
            <div class="ui success message" role="alert">
                {{ $status }} <a href="/dashboard">{{ __('layout.back') }}</a>
            </div>
        @endif

        <form method="post" class="ui form">
            @csrf
            <div class="field">
                <label for="keyName">{{ __('dashboard.edit.name._') }}</label>
                <input type="text" id="keyName" name="name" aria-describedby="nameHelp" placeholder="{{ __('dashboard.edit.name.placeholder') }}" value="{{ $key->comment }}">
                <small id="nameHelp">{{ __('dashboard.edit.name.tooltip') }}</small>
            </div>
            <button type="submit" class="ui primary button">{{ __('dashboard.edit.save') }}</button>
            <delete-button keyid="{{ $key->id }}" :lang="lang"></delete-button>
            <noscript>
                <a href="/delete/{{ $key->id }}" class="ui red button">{{ __('dashboard.edit.delete') }}</a>
            </noscript>
        </form>
    </div>
</div>
@endsection
