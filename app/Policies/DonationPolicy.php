<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the donation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list donations');
    }

    /**
     * Determine whether the donation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function view(User $user, Donation $model)
    {
        return $user->hasPermissionTo('view donations');
    }

    /**
     * Determine whether the donation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create donations');
    }

    /**
     * Determine whether the donation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function update(User $user, Donation $model)
    {
        return $user->hasPermissionTo('update donations');
    }

    /**
     * Determine whether the donation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function delete(User $user, Donation $model)
    {
        return $user->hasPermissionTo('delete donations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete donations');
    }

    /**
     * Determine whether the donation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function restore(User $user, Donation $model)
    {
        return false;
    }

    /**
     * Determine whether the donation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Donation  $model
     * @return mixed
     */
    public function forceDelete(User $user, Donation $model)
    {
        return false;
    }
}
