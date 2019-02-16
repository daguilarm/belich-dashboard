<?php

namespace App\Policies;

use App\Models\Billing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the User can create the a Billing.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can delete a Billing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Billing  $billing
     * @return mixed
     */
    public function delete(User $user, Billing $billing)
    {
        return true;
    }

    /**
     * Determine whether the User can force delete a Billing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Billing  $billing
     * @return mixed
     */
    public function forceDelete(User $user, Billing $model)
    {
        return true;
    }

    /**
     * Determine whether the User can restore a Billing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Billing  $billing
     * @return mixed
     */
    public function restore(User $user, Billing $model)
    {
        return true;
    }

    /**
     * Determine whether the User can update a Billing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Billing  $billing
     * @return mixed
     */
    public function update(User $user, Billing $model)
    {
        return true;
    }

    /**
     * Determine whether the User can view a Billing.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
       return true;
    }

    /**
     * Determine whether the User can view a Billing.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the User can see the trashed Billings.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Billing  $billing
     * @return mixed
     */
    public function withTrashed(User $user, Billing $model)
    {
        return true;
    }
}
