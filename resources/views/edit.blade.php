@extends('layouts.app')

@section('content')
<div class="ui container">
    <div class="ui segment" v-bind:class="{ inverted: dark  }">
        <h2 class="ui center aligned header">Edit key {{ $key->comment }}</h2>

        @if($status)
            <div class="ui success message" role="alert">
                {{ $status }} <a href="/dashboard">Go back.</a>
            </div>
        @endif

        <form method="post" class="ui form">
            @csrf
            <div class="field">
                <label for="keyName">Key name</label>
                <input type="text" id="keyName" name="name" aria-describedby="nameHelp" placeholder="My computer key" value="{{ $key->comment }}">
                <small id="nameHelp">Use this to make the difference between your keys.</small>
            </div>
            <button type="submit" class="ui primary button">Save</button>
            <delete-button keyid="{{ $key->id }}"></delete-button>
            <noscript>
                <a href="/delete/{{ $key->id }}" class="ui red button">Delete</a>
            </noscript>
        </form>
    </div>
</div>
@endsection
