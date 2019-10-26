<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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
        return false;
    }

    /**
    * Determine whether the User can delete a Profile.
    *
    * @param  \App\User  $user
    * @param  \App\Profile  $profile
    * @return mixed
    */
    public function delete(User $user, Profile $profile)
    {
        return false;
    }

    /**
    * Determine whether the User can force delete a Profile.
    *
    * @param  \App\User  $user
    * @param  \App\Profile  $profile
    * @return mixed
    */
    public function forceDelete(User $user, Profile $profile)
    {
        return true;
    }

    /**
    * Determine whether the User can restore a Profile.
    *
    * @param  \App\User  $user
    * @param  \App\Profile  $profile
    * @return mixed
    */
    public function restore(User $user, Profile $profile)
    {
        return true;
    }

    /**
    * Determine whether the User can update a Profile.
    *
    * @param  \App\User  $user
    * @param  \App\Profile  $profile
    * @return mixed
    */
    public function update(User $user, Profile $profile)
    {
        return true;
    }

    /**
    * Determine whether the User can view a Profile.
    * This method will affect the controller 'show' action
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
    * This method will affect the controller 'index' action
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
    * @return mixed
    */
    public function withTrashed(User $user)
    {
        return true;
    }

    /**
    * Determine whether the User can see the files from the Profiles.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function file(User $user)
    {
        return true;
    }
}
