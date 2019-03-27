#!/usr/bin/env bash
# Akmey.sh auto-generated script
# Install {{ $team->name }} | {{ date('d/m/Y') }}
# This kind of script can be gathered by doing request :
# {!! url('team.<teamname>.sh') !!}
# Enjoy! (Akmey is licensed under GPLv3)

ATH_KEYS_PATH="$HOME/.ssh/authorized_keys"

if [ -n "$1" ]
then
    echo "Installing {{ $team->name }} keys in $1..."
    if [ ! -f $1 ]
    then
        echo "$1 : no such file or directory"
    else
        echo "
# -- Akmey.sh Team:{{ $team->name }} --
@foreach ($team->users as $user)
# User: {{ $user->name }}
@foreach($user->keys as $key)
{{ $key->key }} {{ $key->comment }}
@endforeach
@endforeach# -- Akmey.sh end --" >> $1
        echo "{{ $team->name }} is installed"
        exit 0
    fi
else
    echo "Installing {{ $team->name }} keys in $ATH_KEYS_PATH..."
    if [ ! -f $ATH_KEYS_PATH ]
    then
        echo "$ATH_KEYS_PATH doesn't exist, specify a file or create it."
        exit 1
    else
        echo "
# -- Akmey.sh Team:{{ $team->name }} --
@foreach ($team->users as $user)
# User: {{ $user->name }}
@foreach($user->keys as $key)
{{ $key->key }} {{ $key->comment }}
@endforeach
@endforeach# -- Akmey.sh end --" >> $ATH_KEYS_PATH
        echo "{{ $team->name }} is installed"
        exit 0
    fi
fi
