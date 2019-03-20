@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">{{ __('dashboard.profile._') }}</h2>

        @if ($errors->any())
        <div class="ui error message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($status)
            <div class="ui success message" role="alert">
                {{ $status }} <a href="/dashboard">{{ __('layout.back') }}</a>
            </div>
        @endif

        @if($error)
            <div class="ui error message" role="alert">
                {{ $error }}
            </div>
        @endif

        <form method="post" class="ui form" enctype="multipart/form-data">
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
@endsection
