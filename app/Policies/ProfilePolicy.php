<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the User can create the a Profile.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can delete a Profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function delete(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }

    /**
     * Determine whether the User can force delete a Profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function forceDelete(User $user, Profile $profile)
    {
        return true;
    }

    /**
     * Determine whether the User can restore a Profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function restore(User $user, Profile $profile)
    {
        return true;
    }

    /**
     * Determine whether the User can update a Profile.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }

    /**
     * Determine whether the User can view a Profile (show action).
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function view(User $user, Profile $profile)
    {
       return $user->id === $profile->user_id;
    }

    /**
     * Determine whether the User can view a Profile (index action).
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can see the trashed Profiles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function withTrashed(User $user)
    {
        return $user->id === 1;
    }
}
