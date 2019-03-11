@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h1 class="ui center aligned header">Akmey and your data</h1>
        <h3 class="ui header">What data Akmey collect?</h3>
        <div class="ui list">
            <div class="item">
                <i class="user icon"></i>
                <div class="content">
                    <div class="header">User data</div>
                    <div class="description">These data are personal and under your control.</div>
                    <div class="list">
                        <div class="item">
                            <i class="id card icon"></i>
                            <div class="content">
                                <div class="header">Name, e-mail and hashed password</div>
                                <div class="description">We collect this data to identify you when you register, you can change it.</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="clipboard list icon"></i>
                            <div class="content">
                                <div class="header">Account creation time / Last access time</div>
                                <div class="description">This data allows us, for security reasons, to guarantee the integrity of your account.</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="key icon"></i>
                            <div class="content">
                                <div class="header">SSH public keys</div>
                                <div class="description">Your keys: the ones you add on our website or via the SSH server.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <i class="server icon"></i>
                <div class="content">
                    <div class="header">Server logs</div>
                    <div class="description">Access to Akmey is logged.</div>
                    <div class="list">
                        <div class="item">
                            <i class="id card icon"></i>
                            <div class="content">
                                <div class="header">IP</div>
                                <div class="description">Your IP is saved.</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="sticky note icon"></i>
                            <div class="content">
                                <div class="header">Request</div>
                                <div class="description">Your request (URL, User-Agent & Referer)</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="low vision icon"></i>
                            <div class="content">
                                <div class="header">Log rotation</div>
                                <div class="description">The logs are kept for a maximum of 1 year.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p>That's it ! We don't collect anything else, we don't process your data in analytics, we don't sell it to advertisers, none of that. It stays on our server.</p>
        <div class="ui warning message">
            <div class="header">Use only an Akmey server you trust!</div>
            <div class="content">We cannot guarantee that the server on which you register is secure and respects your data. Check the integrity of the host before registering. Akmey developers cannot be held responsible if data is found to violate this privacy or security policy.</div>
        </div>
        @if ($register)
        <div class="ui three column centered grid">
            <div class="center aligned column">
                <a href="/register" class="ui primary button">I accept the terms, register</a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
