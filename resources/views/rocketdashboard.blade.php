@extends('layouts.app')

@section('content')
@if ($tab)
<meta name="activeTab" content="{{ $tab }}">
@endif
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('dashboard.title') }}</h2>

        @if (session('status'))
            <div class="ui info message" role="alert">
                @if(is_array(session('status')))
                <ul>
                    @foreach (session('status') as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @else
                {{ session('status') }}
                @endif
            </div>
        @endif

        @if ($errors->any())
        <div class="ui error message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h3 class="ui center aligned header">{{ __('dashboard.logged') }}</h3>
        <dashboard-menu :lang="lang" :dark="dark" :activetab="activeTab" v-on:change-tab="setTab"></dashboard-menu>

        <div class="ui segment" id="keys" v-bind:class="{ inverted: dark }" v-if="activeTab == 'keys'">
            <p>{{ __('dashboard.sshnotice', ['ssh' => env('SSH_ACCESS')]) }}</p>

            <new-key csrf="{{ csrf_token() }}" :lang="lang"></new-key>

            <div class="ui pointing label">
                {{ __('dashboard.newkey.tooltip') }}
            </div>

            <table class="ui celled table" v-bind:class="{ inverted: dark }">
                <thead>
                    <tr>
                        <th scope="col">{{ __('dashboard.table.id') }}</th>
                        <th scope="col">{{ __('dashboard.table.name') }}</th>
                        <th scope="col">{{ __('dashboard.table.key') }}</th>
                        <th scope="col">{{ __('dashboard.table.last') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->keys as $key)
                    <tr>
                        <td data-label="{{ __('dashboard.table.id') }}"><strong>{{ $loop->iteration }}</strong></td>
                        <td data-label="{{ __('dashboard.table.name') }}">{{ $key->comment }}</td>
                        <td data-label="{{ __('dashboard.table.key') }}" class="break"><code>{{ $key->key }}</code></td>
                        <td data-label="{{ __('dashboard.table.last') }}">{{ $key->updated_at }}<br/><a href="/edit/{{ $key->id }}" class="ui primary button">{{ __('dashboard.table.edit') }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="ui segment" id="teams" v-bind:class="{ inverted: dark }" v-if="activeTab == 'teams'">

                <div class="ui two column centered grid">
                    <div class="left aligned column">
                        @foreach (Auth::user()->teams as $team)
                        <div class="ui list">
                            <div class="list item">
                                <div class="content">
                                    <a class="header" href="{{ route('team', ['team' => $team->name]) }}"><i class="users icon"></i> {{ $team->name }}</a>
                                    <div class="description">{{ __('profile.createdon', ['date' => date('d/m/Y', strtotime($team->created_at))]) }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="right aligned column">
                        <a href="{{ route('teamcreate') }}" class="ui blue icon labeled button"><i class="plus icon"></i> {{ __('dashboard.team.create') }}</a>
                        <h3 class="ui header">
                            {{ __('dashboard.team.invitations') }}
                        </h3>
                        @if (empty(Auth::user()->invitations->first()))
                        <p>{{ __('dashboard.team.empty') }}</p>
                        @else
                        <div class="ui middle aligned list">
                            @foreach (Auth::user()->invitations as $invitation)
                            <div class="list item">
                                <div class="content">
                                    <a class="header" href="{{ route('team', ['team' => $invitation->team->name]) }}"><i class="users icon"></i> {{ $invitation->team->name }}</a>
                                    <div class="description">{{ __('profile.createdon', ['date' => date('d/m/Y', strtotime($invitation->team->created_at))]) }}</div>
                                    <a href="{{ route('teaminvitationaccept', ['invitationid' => $invitation->id]) }}" class="ui blue button">{{ __('dashboard.team.invitation.accept') }}</a>
                                    <a href="{{ route('teaminvitationignore', ['invitationid' => $invitation->id]) }}" class="ui button">{{ __('dashboard.team.invitation.ignore') }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

        </div>

        <div class="ui segment" id="oauth" v-bind:class="{ inverted: dark }" v-if="activeTab == 'oauth'">
            <passport-authorized-clients v-bind:dark="dark" :lang="lang"></passport-authorized-clients>
            <div class="ui segment" v-bind:class="{ inverted: dark  }">
                <h3 class="ui header">{{ __('dashboard.oauth.dev._') }}</h3>

                <div class="card-body">
                    <passport-clients v-bind:dark="dark" :lang="lang"></passport-clients><br/>
                    <passport-personal-access-tokens v-bind:dark="dark" :lang="lang"></passport-personal-access-tokens>
                </div>
            </div>
        </div>

        <div class="ui segment" id="settings" v-bind:class="{ inverted: dark }" v-if="activeTab == 'settings'">
            <div class="ui grid">
                <div class="five wide center aligned column">
                    <a href="{{ url('/github/login') }}" class="ui teal labeled icon button"><i class="github icon"></i> {{ __('dashboard.settings.github') }}</a>
                </div>
                <div class="six wide center aligned column">
                    <div class="ui buttons" role="group">
                        <a href="/export" class="ui primary button">{{ __('dashboard.settings.export') }}</a>
                        <div class="or" data-text="{{ __('dashboard.settings.or') }}"></div>
                        <a href="javascript:;" onclick="document.getElementById('jsonexport').click();" class="ui primary button">{{ __('dashboard.settings.import') }}</a>
                    </div>
                </div>
                <div class="five wide center aligned column">
                    <delete-account :lang="lang"></delete-account>
                    <noscript><a href="/delete-account" class="ui orange button">{{ __('dashboard.settings.delete._') }}</a></noscript>
                </div>
                <form method="post" action="/import" enctype="multipart/form-data">
                    <input type="file" name="jsonexport" accept=".json" id="jsonexport" onchange="this.form.submit()" style="display:none;"/>
                    {{ csrf_field() }}
                </form>
            </div>
            <form method="post" action="{{ url('profile') }}" class="ui form" enctype="multipart/form-data">
                @csrf
                <div class="ui two column centered grid">
                    <div class="center aligned column">
                        <img class="ui circular centered tiny image" src="/storage/{{ Auth::user()->profilepic }}">
                    </div>
                    <div class="center aligned column">
                        <div class="field">
                            <label for="profilePicture">{{ __('dashboard.profile.picture._') }}</label>
                            <input type="file" name="profilepic" id="profilePicture">
                            <small id="profilePicture">{{ __('dashboard.profile.picture.tooltip') }}</small>
                        </div>
                    </div>
                </div>
                <div class="ui one column centered grid">
                    <div class="center aligned column">
                        <div class="field">
                            <label for="bio">{{ __('dashboard.profile.bio._') }}</label>
                            <textarea name="bio" id="bio" rows="4">{{ Auth::user()->bio }}</textarea>
                            <small id="bio">{{ __('dashboard.profile.bio.tooltip') }}</small>
                        </div>
                    </div>
                </div>
                <div class="ui two column centered grid">
                    <div class="center aligned column">
                        <div class="field">
                            <label for="userName">{{ __('dashboard.profile.username._') }}</label>
                            <input type="text" id="userName" name="username" aria-describedby="nameHelp" placeholder="{{ Auth::user()->name }}">
                            <small id="nameHelp">{{ __('dashboard.profile.username.tooltip') }}</small>
                        </div>
                    </div>
                    <div class="center aligned column">
                        <div class="field">
                            <label for="email">{{ __('dashboard.profile.email._') }}</label>
                            <input type="text" id="email" name="email" aria-describedby="emailHelp" placeholder="{{ Auth::user()->email }}">
                            <small id="emailHelp">{{ __('dashboard.profile.email.tooltip') }}</small>
                        </div>
                    </div>
                </div>
                <div class="ui two column centered grid">
                    <div class="center aligned column">
                        <div class="field">
                            <label for="password">{{ __('dashboard.profile.newpasswd._') }}</label>
                            <input type="password" id="password" name="password" aria-describedby="passwordHelp" placeholder="password123">
                            <small id="passwordHelp">{{ __('dashboard.profile.newpasswd.tooltip') }}</small>
                        </div>
                    </div>
                    <div class="center aligned column">
                        <div class="field">
                            <label for="oldpasswd">{{ __('dashboard.profile.oldpasswd._') }}</label>
                            <input type="password" id="oldpasswd" name="oldpasswd" aria-describedby="oldpasswdHelp" placeholder="oldpasswd123" required="">
                            <small id="oldpasswdHelp">{{ __('dashboard.profile.oldpasswd.tooltip') }}</small>
                        </div>
                    </div>
                </div>
                <div class="ui two column centered grid">
                    <div class="center aligned column">
                        <button type="submit" class="ui primary button">{{ __('dashboard.profile.save') }}</button>
                        <a href="{{ url('/u/'.Auth::user()->name) }}" class="ui grey button">{{ __('dashboard.profile.page') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
