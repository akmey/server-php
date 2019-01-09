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

                    You are logged in!

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
                        @foreach ($keys as $key)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $key->comment }}</td>
                            <td><code>{{ $key->key }}</code></td>
                            <td>{{ date('j/n/Y', $key->lastedit) }}<br/><a href="/edit/{{ $key->id }}" class="btn btn-primary">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
