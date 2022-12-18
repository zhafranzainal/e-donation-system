<?php

namespace App\Policies;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bank can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list banks');
    }

    /**
     * Determine whether the bank can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function view(User $user, Bank $model)
    {
        return $user->hasPermissionTo('view banks');
    }

    /**
     * Determine whether the bank can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create banks');
    }

    /**
     * Determine whether the bank can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function update(User $user, Bank $model)
    {
        return $user->hasPermissionTo('update banks');
    }

    /**
     * Determine whether the bank can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function delete(User $user, Bank $model)
    {
        return $user->hasPermissionTo('delete banks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete banks');
    }

    /**
     * Determine whether the bank can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function restore(User $user, Bank $model)
    {
        return false;
    }

    /**
     * Determine whether the bank can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bank  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bank $model)
    {
        return false;
    }
}
