@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>You are logged in!</h3>

                    <p>Connect to gui@<span/>{{ env('SSH_ACCESS') }} with your favourite SSH client to add your keys or paste your key down below (without key comment).</p>

                    <new-key csrf="{{ csrf_token() }}"></new-key>

                    <p class="text-center">We accept major key types.</p>

                    <table class="table table-bordered">
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
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $key->comment }}</td>
                                <td><code>{{ $key->key }}</code></td>
                                <td>{{ $key->updated_at }}<br/><a href="/edit/{{ $key->id }}" class="btn btn-primary">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3>Settings</h3>
                    <div class="btn-group no-flex" role="group">
                        <a href="/export" class="btn btn-primary">Export my account<br/><span class="badge badge-secondary">This will export your data (JSON)</span></a>
                        <a href="javascript:;" onclick="document.getElementById('jsonexport').click();" class="btn btn-primary">Import my account<br/><span class="badge badge-secondary">This will import the data of your JSON export</span></a>
                    </div>
                    <br><br>
                    <div class="btn-group no-flex" role="group">
                        <delete-account></delete-account>
                        <noscript><a href="/delete-account" class="btn btn-danger">Delete my account<br/><span class="badge badge-warning">This will delete all your account data from this server</span></a></noscript>
                        <a href="/my-profile" class="btn btn-primary">Change my profile<br/><span class="badge badge-secondary">Edit your username, e-mail address</span></a>
                        <a href="/dashboard/apps" class="btn btn-secondary">OAuth Apps<br/><span class="badge badge-primary">Open the OAuth Apps settings</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="/import" enctype="multipart/form-data">
    <input type="file" name="jsonexport" accept=".json" id="jsonexport" onchange="this.form.submit()" style="display:none;"/>
    <!--<span>This will import the data of your JSON export.</span>-->
    {{ csrf_field() }}
</form>
@endsection
