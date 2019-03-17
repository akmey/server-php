<?php

namespace App\Policies;

use App\User;
use App\Key;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create keys.
     *
     * @param  \App\User  $user
     * @return boolean
     */
    public function create(User $user)
    {
        if ($user) { return true; } // TODO: a ban system ?
    }

    /**
     * Determine whether the user can update the key.
     *
     * @param  \App\User  $user
     * @param  \App\Key  $key
     * @return boolean
     */
    public function update(User $user, Key $key)
    {
        return $user->id == $key->user_id;
    }

    /**
     * Determine whether the user can delete the key.
     *
     * @param  \App\User  $user
     * @param  \App\Key  $key
     * @return boolean
     */
    public function delete(User $user, Key $key)
    {
        return $user->id == $key->user_id;
    }
}
