@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark }">
        <div class="ui centered two column grid">
            <div class="ui centered column">
                <a class="ui orange left ribbon label">{{ __('profile.overview') }}</a>
                <h2 class="ui header">
                    <img src="/storage/{{ $user->profilepic }}">
                    <div class="content">
                        {{ $user->name }} @if ($user->id == Auth::id()) {{ __('profile.you') }} @endif
                        <div class="sub header">{{ __('profile.registered', ['date' => date('d/m/Y', strtotime($user->created_at))]) }}</div>
                    </div>
                </h2>
                @if ($user->id == Auth::id()) <a href="{{ route('myprofile') }}" class="ui primary labeled icon button"><i class="edit icon"></i> {{ __('profile.edit') }}</a> @endif
                <br><br>
                <a class="ui teal left ribbon label">{{ __('profile.bio') }}</a>
                <br><br>
                {!! $bio !!}
            </div>
            <div class="ui centered column">
                <a class="ui blue right ribbon label">{{ __('profile.keys') }}</a>
                <div class="ui list">
                    @foreach ($user->keys as $key)
                        <div class="item">
                            <i class="key icon"></i>
                            <div class="content">
                                <a class="header">{{ $key->comment }}</a>
                                <div class="description break">{{ substr($key->key, 0, 50) }}...</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
