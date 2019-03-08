@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <passport-authorized-clients v-bind:dark="dark"></passport-authorized-clients>
        <div class="ui segment" v-bind:class="{ inverted: dark  }">
            <h3 class="ui header">Developer</h3>

            <div class="card-body">
                <passport-clients v-bind:dark="dark"></passport-clients><br/>
                <passport-personal-access-tokens v-bind:dark="dark"></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>
@endsection
