@extends('layouts.app')

@section('content')
    <div class="ui container">
        <div class="ui segment" v-bind:class="{ inverted: dark }">
            <h2 class="ui icon center aligned header">
                <i class="github icon"></i>
                <div class="content">
                    Great!
                    <div class="sub header">Now choose the keys you want to import.</div>
                </div>
            </h2>
            <form action="/github/import" method="post">
                @csrf
                @foreach ($keys as $key)
                    <div class="ui checkbox">
                        <input type="checkbox" name="{{ $key['id'] }}">
                        <label>
                            <h4 class="ui header">
                                {{ $key['title'] }}
                                <div class="sub header">{{ substr($key['key'], 0, 50) }}...</div>
                            </h4>
                        </label>
                    </div>
                    <br><br>
                @endforeach
                <button class="ui primary button" type="submit">Import!</button>
            </form>
        </div>
    </div>
@endsection
