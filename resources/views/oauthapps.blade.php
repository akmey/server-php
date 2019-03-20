@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <passport-authorized-clients v-bind:dark="dark" :lang="lang"></passport-authorized-clients>
        <div class="ui segment" v-bind:class="{ inverted: dark  }">
            <h3 class="ui header">{{ __('dashboard.oauth.dev._') }}</h3>

            <div class="card-body">
                <passport-clients v-bind:dark="dark" :lang="lang"></passport-clients><br/>
                <passport-personal-access-tokens v-bind:dark="dark" :lang="lang"></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>
@endsection
