<?php

namespace App\Policies;

use App\User;
use App\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create Teams.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user) { return true; }
    }

    /**
     * Determine whether the user can update the Team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        if ($team->adminopen && $team->users()->where('id', $user->id)->first()) {
            return true;
        } else if ($user->id == $team->creator_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the Team's permissions.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function permUpdate(User $user, Team $team)
    {
        return $user->id == $team->creator_id;
    }

    /**
     * Determine whether the user can kick a member from the Team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function kickMember(User $user, Team $team)
    {
        return $user->id == $team->creator_id;
    }

    /**
     * Determine whether the user can delete the Team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function delete(User $user, Team $team)
    {
        return $user->id == $team->creator_id;
    }

    /**
     * Determine whether the user can restore the Team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function restore(User $user, Team $team)
    {
        return $user->id == $team->creator_id;
    }

    /**
     * Determine whether the user can permanently delete the Team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function forceDelete(User $user, Team $team)
    {
        return $user->id == $team->creator_id;
    }
}
