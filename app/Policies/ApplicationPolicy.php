<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the application can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list applications');
    }

    /**
     * Determine whether the application can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function view(User $user, Application $model)
    {
        return $user->hasPermissionTo('view applications');
    }

    /**
     * Determine whether the application can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create applications');
    }

    /**
     * Determine whether the application can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function update(User $user, Application $model)
    {
        return $user->hasPermissionTo('update applications');
    }

    /**
     * Determine whether the application can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function delete(User $user, Application $model)
    {
        return $user->hasPermissionTo('delete applications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete applications');
    }

    /**
     * Determine whether the application can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function restore(User $user, Application $model)
    {
        return false;
    }

    /**
     * Determine whether the application can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Application  $model
     * @return mixed
     */
    public function forceDelete(User $user, Application $model)
    {
        return false;
    }
}
