@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h1 class="ui center aligned header">What's Akmey?</h1>
        <p>Akmey is like keyservers, but not for GPG keys, for SSH ones! It has a simple <a href="{{ env('SWAGGER_URL', 'https://leonekmi.fr/swagger/') }}" target="_blank">API</a> and apps to retrieve keys and add it to your authorized_keys file.</p>

        <h2 class="ui header">Where i can download the apps?</h2>
        <p>We try to make Akmey accessible everywhere, so we have a Go client (alpha) released for every platform, everything is under open-source license.</p>
        <div class="ui relaxed divided list">
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-install">akmey/akmey-install</a>
                    <div class="description">Automated install script</div>
                </div>
            </div>
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-client">akmey/akmey-client</a>
                    <div class="description">Akmey client</div>
                </div>
            </div>
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-server">akmey/akmey-server</a>
                    <div class="description">Publish your SSH public keys in one place, fetch it from one place too!</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
