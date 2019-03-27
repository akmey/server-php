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
                @if ($user->id == Auth::id()) <a href="{{ route('dashboardsection', ['section' => 'settings']) }}" class="ui primary labeled icon button"><i class="edit icon"></i> {{ __('profile.edit') }}</a> @endif
                <br><br>
                <a class="ui teal left ribbon label">{{ __('profile.bio') }}</a>
                <br><br>
                {!! $bio !!}
            </div>
            <div class="ui centered column">
                <a class="ui blue right ribbon label">{{ __('profile.keys') }}</a>
                <div class="ui list">
                    @foreach ($user->keys as $key)
                        <key content="{{ $key->key }}" comment="{{ $key->comment }}" :lang="lang"></key>
                    @endforeach
                </div>
                <br><br>
                <a class="ui red right ribbon label">{{ __('profile.install') }}</a>
                <div class="ui list">
                    <div class="item">
                        <i class="npm icon"></i>
                        <div class="content">
                            <a class="header" href="https://www.npmjs.com/package/akmey" target="_blank">{{ __('profile.node._') }}</a>
                            <div class="description break">@lang('profile.node.desc', ['cmd' => '<code class="code">npx akmey i ' . $user->name . '</code>'])</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="terminal icon"></i>
                        <div class="content">
                            <a class="header" href="{{ url('/'.$user->name.'.sh') }}" target="_blank">{{ __('profile.sh._') }}</a>
                            <div class="description break">@lang('profile.sh.desc', ['user' => $user->name])</div>
                        </div>
                    </div>
                    <copykeys :lang="lang" user="{{ $user->name }}"
                    content="@foreach ($user->keys as $key) {{ $key->key }} {{ $key->comment }}
@endforeach">
                    </copykeys>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
