<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body {
          background-color: #636363;
        }
        body > .grid {
          height: 100%;
        }
        .column {
          max-width: 450px;
        }
      </style>
</head>
<body>
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui inverted header">
                        Authorization Request
            </h2>

            <div class="ui stacked segment" v-bind:class="{ inverted: dark }">
                <!-- Introduction -->
                <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

                <!-- Scope List -->
                @if (count($scopes) > 0)
                    <div class="ui segment" v-bind:class="{ inverted: dark }">
                            <p><strong>This application will be able to:</strong></p>

                            <ul>
                                @foreach ($scopes as $scope)
                                    <li>{{ $scope->description }}</li>
                                @endforeach
                            </ul>
                    </div>
                @endif

                <br>
                <div class="ui grid">
                    <div class="three column row">
                        <div class="left floated column">
                            <!-- Authorize Button -->
                            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="ui primary labeled icon button"><i class="user icon"></i> Authorize</button>
                            </form>
                        </div>


                        <div class="right floated column">
                            <!-- Cancel Button -->
                            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="ui red labeled icon button"><i class="close icon"></i> Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
