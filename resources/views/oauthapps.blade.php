@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <passport-authorized-clients></passport-authorized-clients>

            <div class="card">
                <div class="card-header">Developer</div>

                <div class="card-body">
                    <passport-clients></passport-clients><br/>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
