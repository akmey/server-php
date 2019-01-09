@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit key {{ $key->comment }}</div>

                <div class="card-body">
                    @if($status)
                        <div class="alert alert-success" role="alert">
                            {{ $status }} <a href="/dashboard">Go back.</a>
                        </div>
                    @endif

                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="keyName">Key name</label>
                            <input type="text" class="form-control" id="keyName" name="name" aria-describedby="nameHelp" placeholder="My computer key" value="{{ $key->comment }}">
                            <small id="nameHelp" class="form-text text-muted">Use this to make the difference between your keys.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <delete-button keyid="{{ $key->id }}"></delete-button>
                        <noscript>
                            <a href="/delete/{{ $key->id }}" class="btn btn-danger">Delete</a>
                        </noscript>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
