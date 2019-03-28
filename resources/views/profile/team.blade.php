@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark }">
        <div class="ui centered two column grid">
            <div class="ui centered column">
                <a class="ui orange left ribbon label">{{ __('profile.teamoverview') }}</a>
                <h2 class="ui header">
                    <div class="content">
                        {{ $team->name }}
                        <div class="sub header">{{ __('profile.createdon', ['date' => date('d/m/Y', strtotime($team->created_at))]) }}</div>
                    </div>
                </h2>
                <h4 class="ui header">
                    <img src="/storage/{{ $team->creator->profilepic }}">
                    <div class="content">
                        {{ __('profile.created', ['user' => $team->creator->name]) }}
                        <div class="sub header">{{ __('profile.registered', ['date' => date('d/m/Y', strtotime($team->creator->created_at))]) }}</div>
                    </div>
                </h4>
                @if (Auth::user()->can('update', $team)) <a href="{{ route('team.admin', ['teamid' => $team->id]) }}" class="ui primary labeled icon button"><i class="edit icon"></i> {{ __('profile.edit') }}</a> @endif
                <br><br>
                <a class="ui teal left ribbon label">{{ __('profile.bio') }}</a>
                <br><br>
                {!! $bio !!}
            </div>
            <div class="ui centered column">
                <a class="ui blue right ribbon label">{{ __('profile.users') }}</a>
                <div class="ui list">
                    @foreach ($team->users()->get() as $user)
                    <div class="item">
                        <img class="ui avatar image" src="/storage/{{ $user->profilepic }}">
                        <div class="content">
                            <a class="header" href="{{ url('/u/'.$user->name) }}">{{ $user->name }}</a>
                            <div class="description">{{ __('profile.registered', ['date' => date('d/m/Y', strtotime($user->created_at))]) }}</div>
                        </div>
                        <div class="right floated content">
                            @if (Auth::user()->can('kickMember', $team) && Auth::id() != $user->id) <a href="{{ route('team.admin.kick', ['teamid' => $team->id, 'userid' => $user->id]) }}" class="ui orange tiny button">{{ __('profile.kick') }}</a> @endif
                            @if (Auth::id() == $user->id && Auth::user()->cannot('kickMember', $team)) <a href="{{ route('team.admin.kick', ['teamid' => $team->id, 'userid' => $user->id]) }}" class="ui orange tiny button">{{ __('team.member.quit') }}</a> @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @if (Auth::user()->can('update', $team))
                <new-member teamid="{{ $team->id }}" :lang="lang"></new-member>
                @endif
                <br><br>
                <a class="ui red right ribbon label">{{ __('profile.install') }}</a>
                <div class="ui list">
                    <div class="item">
                        <i class="npm icon"></i>
                        <div class="content">
                            <a class="header" href="https://www.npmjs.com/package/akmey" target="_blank">{{ __('profile.node._') }}</a>
                            <div class="description break">@lang('profile.node.desc', ['cmd' => '<code class="code">npx akmey ti ' . $team->name . '</code>'])</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="terminal icon"></i>
                        <div class="content">
                            <a class="header" href="{{ url('/team.'.$team->name.'.sh') }}" target="_blank">{{ __('profile.sh._') }}</a>
                            <div class="description break">@lang('profile.sh.desc', ['user' => $team->name])</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
