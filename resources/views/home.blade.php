@extends('layouts.app')

@section('content')
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

        <h3 class="ui center aligned header">{{ __('dashboard.logged') }}</h3>

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

        <h3>{{ __('dashboard.settings._') }}</h3>
        <a href="{{ url('/github/login') }}" class="ui teal labeled icon button"><i class="github icon"></i> {{ __('dashboard.settings.github') }}</a>
        <div class="ui buttons" role="group">
            <a href="/export" class="ui primary button">{{ __('dashboard.settings.export') }}</a>
            <div class="or" data-text="{{ __('dashboard.settings.or') }}"></div>
            <a href="javascript:;" onclick="document.getElementById('jsonexport').click();" class="ui primary button">{{ __('dashboard.settings.import') }}</a>
        </div>
        <br><br>
        <div class="ui buttons" role="group">
            <delete-account :lang="lang"></delete-account>
            <noscript><a href="/delete-account" class="ui red button">{{ __('dashboard.settings.delete._') }}</a></noscript>
            <a href="/my-profile" class="ui primary button">{{ __('dashboard.settings.edit._') }}<br/><span>{{ __('dashboard.settings.edit.tooltip') }}</span></a>
            <a href="/dashboard/apps" class="ui button">{{ __('dashboard.settings.oauth._') }}<br/><span class="badge badge-primary">{{ __('dashboard.settings.oauth.tooltip') }}</span></a>
        </div>
    </div>
</div>
<form method="post" action="/import" enctype="multipart/form-data">
    <input type="file" name="jsonexport" accept=".json" id="jsonexport" onchange="this.form.submit()" style="display:none;"/>
    <!--<span>This will import the data of your JSON export.</span>-->
    {{ csrf_field() }}
</form>
@endsection
