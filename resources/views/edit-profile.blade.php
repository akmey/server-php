@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit my profile</div>

                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($status)
                        <div class="alert alert-success" role="alert">
                            {{ $status }} <a href="/dashboard">Go back.</a>
                        </div>
                    @endif

                    @if($error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endif

                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="userName">Username</label>
                            <input type="text" class="form-control" id="userName" name="username" aria-describedby="nameHelp" placeholder="{{ Auth::user()->name }}">
                            <small id="nameHelp" class="form-text text-muted">It must be unique, alphanumeric.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="{{ Auth::user()->email }}">
                            <small id="emailHelp" class="form-text text-muted">If you change that, you need to confirm the new address before using it.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="password123">
                            <small id="passwordHelp" class="form-text text-muted">Choose a faster, stronger, better password!</small>
                        </div>
                        <div class="form-group">
                            <label for="oldpasswd">Old Password</label>
                            <input type="password" class="form-control" id="oldpasswd" name="oldpasswd" aria-describedby="oldpasswdHelp" placeholder="oldpasswd123" required="">
                            <small id="oldpasswdHelp" class="form-text text-muted">Please retype your password for any change.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
