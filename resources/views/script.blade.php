#!/usr/bin/env bash
# Akmey.sh auto-generated script
# Install {{ $user->name }} | {{ date('d/m/Y') }}
# This kind of script can be gathered by doing request :
# {!! url('<username>.sh') !!}
# Enjoy! (Akmey is licensed under GPLv3)

ATH_KEYS_PATH="$HOME/.ssh/authorized_keys"

# checks if the ~/.ssh folder exists, if not, creates it
[ ! -d "$HOME/.ssh" ] && mkdir $HOME/.ssh

if [ ! -f $ATH_KEYS_PATH ]; then touch $ATH_KEYS_PATH; fi

if [ -n "$1" ]
then
    echo "Installing {{ $user->name }} keys in $1..."
    if [ ! -f $1 ]
    then
        echo "$1 : no such file or directory"
    else
        echo "
# -- Akmey.sh User:{{ $user->name }} --
@foreach ($user->keys as $key)
{{ $key->key }} {{ $key->comment }}
@endforeach# -- Akmey.sh end --" >> $1
        echo "{{ $user->name }} is installed"
        exit 0
    fi
else
    echo "Installing {{ $user->name }} keys in $ATH_KEYS_PATH..."
        echo "
# -- Akmey.sh User:{{ $user->name }} --
@foreach ($user->keys as $key)
{{ $key->key }} {{ $key->comment }}
@endforeach# -- Akmey.sh end --" >> $ATH_KEYS_PATH
        echo "{{ $user->name }} is installed"
        exit 0
    fi
fi
