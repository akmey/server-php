@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header"><i class="users icon"></i> {{ __('team.form.create.title') }}</h2>

        @if ($errors->any())
        <div class="ui error message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- @if($status)
            <div class="ui success message" role="alert">
                {{ $status }} <a href="/dashboard">{{ __('layout.back') }}</a>
            </div>
        @endif

        @if($error)
            <div class="ui error message" role="alert">
                {{ $error }}
            </div>
        @endif --}}

        <form method="post" class="ui form" enctype="multipart/form-data">
            @csrf
            <div class="ui one column centered grid">
                <div class="center aligned column">
                    <div class="field">
                        <label for="orgName">{{ __('team.form.name._') }}</label>
                        <input type="text" name="name" id="orgName">
                        <small id="orgName">{{ __('team.form.name.tooltip') }}</small>
                    </div>
                </div>
            </div>
            <div class="ui one column centered grid">
                <div class="center aligned column">
                    <div class="field">
                        <label for="bio">{{ __('team.form.bio._') }}</label>
                        <textarea name="bio" id="bio" rows="4"></textarea>
                        <small id="bio">{{ __('team.form.bio.tooltip') }}</small>
                    </div>
                </div>
            </div>
            <h3 class="ui center aligned header">
                {{ __('team.form.adminopen.title') }}
            </h3>
            <div class="ui two column centered grid">
                <div class="center aligned column">
                    <div class="ui radio checkbox">
                        <input type="radio" name="adminopen" value="yes">
                        <label>{{ __('team.form.adminopen.yes') }}</label>
                    </div>
                </div>
                <div class="center aligned column">
                    <div class="ui radio checkbox">
                        <input type="radio" name="adminopen" value="no">
                        <label>{{ __('team.form.adminopen.no') }}</label>
                    </div>
                </div>
                <small>{{ __('team.form.adminopen.tooltip.create') }}</small>
            </div>
            <div class="ui one column centered grid">
                <div class="center aligned column">
                    <button type="submit" class="ui primary button">{{ __('team.form.create.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
