<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the User can create the a Profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can delete a Profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the User can force delete a Profile.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the User can restore a Profile.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the User can update a Profile.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the User can view a Profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
       return true;
    }

    /**
     * Determine whether the User can view a Profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can see the trashed Profiles.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function withTrashed(User $user, User $model)
    {
        return true;
    }
}
