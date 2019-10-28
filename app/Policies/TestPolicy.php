<?php

namespace App\Policies;

use App\Test;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
    * Determine whether the User can create the a Test.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function create(User $user)
    {
        return true;
    }

    /**
    * Determine whether the User can delete a Test.
    *
    * @param  \App\User  $user
    * @param  \App\Test  $test
    * @return mixed
    */
    public function delete(User $user, Test $test)
    {
        return true;
    }

    /**
    * Determine if the user can access or download files
    *
    * @param  \App\User  $user
    * @param  \App\Test  $test
    * @return mixed
    */
    public function file(User $user, Test $test)
    {
        return true;
    }

    /**
    * Determine whether the User can force delete a Test.
    *
    * @param  \App\User  $user
    * @param  \App\Test  $test
    * @return mixed
    */
    public function forceDelete(User $user, Test $test)
    {
        return true;
    }

    /**
    * Determine whether the User can restore a Test.
    *
    * @param  \App\User  $user
    * @param  \App\Test  $test
    * @return mixed
    */
    public function restore(User $user, Test $test)
    {
        return true;
    }

    /**
    * Determine whether the User can update a Test.
    *
    * @param  \App\User  $user
    * @param  \App\Test  $test
    * @return mixed
    */
    public function update(User $user, Test $test)
    {
        return true;
    }

    /**
    * Determine whether the User can view a Test.
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
    * Determine whether the User can view a Test.
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
    * Determine whether the User can see the trashed model.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function withTrashed(User $user)
    {
        return true;
    }
}
