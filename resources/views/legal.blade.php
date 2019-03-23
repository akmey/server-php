@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h1 class="ui center aligned header">{{ __('doc.legal.title') }}</h1>
        <p>@lang('doc.legal.agpl._', ['app' => config('app.name'), 'link' => '<a href="' . env('SOURCE_URL', 'https://github.com/akmey/server-php') . '" target="_blank">' . __('doc.legal.agpl.link') . '</a>'])</p>
        <p>{{ __('doc.legal.host', ['host' => env('LEGAL_HOST'), 'details' => env('LEGAL_DETAILS'), 'name' => env('LEGAL_NAME')]) }}</p>
        @if (env('LEGAL_MORE'))
        <p>{{ __('doc.legal.more') }}</p>
        <p>{{ env('LEGAL_MORE') }}</p>
        @endif
    </div>
</div>
@endsection
