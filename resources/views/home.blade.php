@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">Dashboard</h2>

        @if (session('status'))
            <div class="ui success message" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h3 class="ui center aligned header">You are logged in!</h3>

        <stories></stories>

        <p>Connect to gui@<span/>{{ env('SSH_ACCESS') }} with your favourite SSH client to add your keys or paste your key down below (without key comment).</p>

        <new-key csrf="{{ csrf_token() }}"></new-key>

        <div class="ui pointing label">
                We accept major key types.
        </div>

        <table class="ui celled table" v-bind:class="{ inverted: dark }">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Key name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Last updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->keys as $key)
                <tr>
                    <td data-label="#"><strong>{{ $loop->iteration }}</strong></td>
                    <td data-label="Key name">{{ $key->comment }}</td>
                    <td data-label="Content" class="break"><code>{{ $key->key }}</code></td>
                    <td data-label="Last updated">{{ $key->updated_at }}<br/><a href="/edit/{{ $key->id }}" class="ui primary button">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Settings</h3>
        <div class="ui buttons" role="group">
            <a href="/export" class="ui primary button">Export my account</a>
            <div class="or"></div>
            <a href="javascript:;" onclick="document.getElementById('jsonexport').click();" class="ui primary button">Import my account</a>
        </div>
        <br><br>
        <div class="ui buttons" role="group">
            <delete-account></delete-account>
            <noscript><a href="/delete-account" class="ui red button">Delete my account</a></noscript>
            <a href="/my-profile" class="ui primary button">Change my profile<br/><span class="badge badge-secondary">Edit your username, e-mail address</span></a>
            <a href="/dashboard/apps" class="ui button">OAuth Apps<br/><span class="badge badge-primary">Open the OAuth Apps settings</span></a>
        </div>
    </div>
</div>
<form method="post" action="/import" enctype="multipart/form-data">
    <input type="file" name="jsonexport" accept=".json" id="jsonexport" onchange="this.form.submit()" style="display:none;"/>
    <!--<span>This will import the data of your JSON export.</span>-->
    {{ csrf_field() }}
</form>
@endsection
