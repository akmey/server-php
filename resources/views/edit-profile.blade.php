@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">Edit my profile</h2>

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
                {{ $status }} <a href="/dashboard">Go back.</a>
            </div>
        @endif

        @if($error)
            <div class="ui error message" role="alert">
                {{ $error }}
            </div>
        @endif

        <form method="post" class="ui form">
            @csrf
            <div class="field">
                <label for="userName">Username</label>
                <input type="text" id="userName" name="username" aria-describedby="nameHelp" placeholder="{{ Auth::user()->name }}">
                <small id="nameHelp">It must be unique, alphanumeric.</small>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" aria-describedby="emailHelp" placeholder="{{ Auth::user()->email }}">
                <small id="emailHelp">If you change that, you need to confirm the new address before using it.</small>
            </div>
            <div class="field">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" aria-describedby="passwordHelp" placeholder="password123">
                <small id="passwordHelp">Choose a faster, stronger, better password!</small>
            </div>
            <div class="field">
                <label for="oldpasswd">Old Password</label>
                <input type="password" id="oldpasswd" name="oldpasswd" aria-describedby="oldpasswdHelp" placeholder="oldpasswd123" required="">
                <small id="oldpasswdHelp">Please retype your password for any change.</small>
            </div>
            <button type="submit" class="ui primary button">Save</button>
        </form>
    </div>
</div>
@endsection
