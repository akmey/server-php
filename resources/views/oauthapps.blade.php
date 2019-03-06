@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment">
        <passport-authorized-clients></passport-authorized-clients>
        <div class="ui segment">
            <h3 class="ui header">Developer</h3>

            <div class="card-body">
                <passport-clients></passport-clients><br/>
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>
@endsection
