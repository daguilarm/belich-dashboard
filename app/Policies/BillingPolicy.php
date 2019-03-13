<?php

namespace App\Policies;

use App\Billing;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillingPolicy
{
    use HandlesAuthorization;

    /**
    * Determine whether the User can create the a Billing.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function create(User $user)
    {
        return true;
    }

    /**
    * Determine whether the User can delete a Billing.
    *
    * @param  \App\User  $user
    * @param  \App\Billing  $billing
    * @return mixed
    */
    public function delete(User $user, Billing $billing)
    {
        return true;
    }

    /**
    * Determine if the user can access or download files
    *
    * @param  \App\User  $user
    * @param  \App\Billing  $billing
    * @return mixed
    */
    public function file(User $user, Billing $billing)
    {
        return true;
    }

    /**
    * Determine whether the User can force delete a Billing.
    *
    * @param  \App\User  $user
    * @param  \App\Billing  $billing
    * @return mixed
    */
    public function forceDelete(User $user, Billing $billing)
    {
        return true;
    }

    /**
    * Determine whether the User can restore a Billing.
    *
    * @param  \App\User  $user
    * @param  \App\Billing  $billing
    * @return mixed
    */
    public function restore(User $user, Billing $billing)
    {
        return true;
    }

    /**
    * Determine whether the User can update a Billing.
    *
    * @param  \App\User  $user
    * @param  \App\Billing  $billing
    * @return mixed
    */
    public function update(User $user, Billing $billing)
    {
        return true;
    }

    /**
    * Determine whether the User can view a Billing.
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
    * Determine whether the User can view a Billing.
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
