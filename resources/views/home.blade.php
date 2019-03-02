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

                    <p>Connect to gui@<span/>{{ env('SSH_ACCESS') }} with your favourite SSH client to add your keys.</p>

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
                    <delete-account></delete-account>
                    <noscript><a href="/delete-account" class="btn btn-danger">Delete my account</a></noscript> <span>This will delete all your account data from this server.</span>
                    <br><br>
                    <a href="/export" class="btn btn-primary">Export my account</a> <span>This will export your data (JSON).</span>
                    <br><br>
                    <form method="post" action="/import" enctype="multipart/form-data">
                        <label class="btn btn-primary">
                            <input type="file" name="jsonexport" accept=".json" onchange="this.form.submit()" style="display:none;"/>
                            Import my account
                        </label>
                        <span>This will import the data of your JSON export.</span>
                        {{ csrf_field() }}
                    </form>
                    <a href="/dashboard/apps" class="btn btn-primary">OAuth Apps</a> <span>Open the OAuth Apps settings.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
