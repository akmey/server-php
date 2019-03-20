@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h1 class="ui center aligned header">{{ __('doc.privacy._') }}</h1>
        <h3 class="ui header">{{ __('doc.privacy.head') }}</h3>
        <div class="ui list">
            <div class="item">
                <i class="user icon"></i>
                <div class="content">
                    <div class="header">{{ __('doc.privacy.user._') }}</div>
                    <div class="description">{{ __('doc.privacy.user.desc') }}</div>
                    <div class="list">
                        <div class="item">
                            <i class="id card icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.user.name._') }}</div>
                                <div class="description">{{ __('doc.privacy.user.name.desc') }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="clipboard list icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.user.time._') }}</div>
                                <div class="description">{{ __('doc.privacy.user.time.desc') }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="key icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.user.keys._') }}</div>
                                <div class="description">{{ __('doc.privacy.user.keys.desc') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <i class="server icon"></i>
                <div class="content">
                    <div class="header">{{ __('doc.privacy.logs._') }}</div>
                    <div class="description">{{ __('doc.privacy.logs.desc') }}</div>
                    <div class="list">
                        <div class="item">
                            <i class="id card icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.logs.ip._') }}</div>
                                <div class="description">{{ __('doc.privacy.logs.ip.desc') }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="sticky note icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.logs.req._') }}</div>
                                <div class="description">{{ __('doc.privacy.logs.req.desc') }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="low vision icon"></i>
                            <div class="content">
                                <div class="header">{{ __('doc.privacy.logs.rot._') }}</div>
                                <div class="description">{{ __('doc.privacy.logs.rot.desc') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p>{{ __('doc.privacy.end') }}</p>
        <div class="ui warning message">
            <div class="header">{{ __('doc.privacy.warning._') }}</div>
            <div class="content">{{ __('doc.privacy.warning.content') }}</div>
        </div>
        @if ($register)
        <div class="ui three column centered grid">
            <div class="center aligned column">
                <a href="/register" class="ui primary button">{{ __('doc.privacy.btn') }}</a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
