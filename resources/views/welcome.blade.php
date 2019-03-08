@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark }">
        <h1 class="ui center aligned icon header">
            <i class="key icon"></i>
            <div class="content">
                Akmey
                <div class="sub header">Forgot your keys, just remember your name (easy!).</div>
            </div>
        </h1>
        <div class="ui equal width grid">
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="user icon"></i>
                    <div class="content">
                        User
                        <div class="sub header">Add all your keys (RSA, ED25519) to Akmey and save it in one place!</div>
                    </div>
                </h2>
            </div>
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="wrench icon"></i>
                    <div class="content">
                        Tools
                        <div class="sub header">Tools are available and can help you to authorize someone to connect on your server.</div>
                    </div>
                </h2>
            </div>
            <div class="column">
                <h2 class="ui center aligned icon header">
                    <i class="github icon"></i>
                    <div class="content">
                        Open-source
                        <div class="sub header">All the Akmey source code is available on GitHub.</div>
                    </div>
                </h2>
            </div>
        </div>
        <div class="ui three column centered grid">
            <div class="center aligned column">
                <a href="/register" class="ui primary button">Register now!</a>
                <a href="/doc" class="ui grey button">More...</a>
            </div>
        </div>
    </div>
</div>
@endsection
