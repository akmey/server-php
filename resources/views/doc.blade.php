@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h1 class="ui center aligned header">{{ __('doc.readme.akmey.title') }}</h1>
        <p>@lang('doc.readme.akmey.desc._', ['link' => '<a href="' . env('SWAGGER_URL', 'https://leonekmi.fr/swagger/') . '" target="_blank">' . __('doc.readme.akmey.desc.link') . '</a>'])</p>

        <h2 class="ui header">{{ __('doc.readme.apps.title') }}</h2>
        <p>{{ __('doc.readme.apps.head') }}</p>
        <div class="ui relaxed divided list">
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-nodejs">akmey/akmey-nodejs</a>
                    <div class="description">{{ __('doc.readme.apps.list.node') }}</div>
                </div>
            </div>
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-install">akmey/akmey-install</a>
                    <div class="description">{{ __('doc.readme.apps.list.install') }}</div>
                </div>
            </div>
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-client">akmey/akmey-client</a>
                    <div class="description">{{ __('doc.readme.apps.list.go') }}</div>
                </div>
            </div>
            <div class="item">
                <i class="large github middle aligned icon"></i>
                <div class="content">
                    <a class="header" href="https://github.com/akmey/akmey-server">akmey/akmey-server</a>
                    <div class="description">{{ __('doc.readme.apps.list.server') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
