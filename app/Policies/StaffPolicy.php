<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the staff can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list staffs');
    }

    /**
     * Determine whether the staff can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function view(User $user, Staff $model)
    {
        return $user->hasPermissionTo('view staffs');
    }

    /**
     * Determine whether the staff can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create staffs');
    }

    /**
     * Determine whether the staff can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function update(User $user, Staff $model)
    {
        return $user->hasPermissionTo('update staffs');
    }

    /**
     * Determine whether the staff can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function delete(User $user, Staff $model)
    {
        return $user->hasPermissionTo('delete staffs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete staffs');
    }

    /**
     * Determine whether the staff can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function restore(User $user, Staff $model)
    {
        return false;
    }

    /**
     * Determine whether the staff can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Staff  $model
     * @return mixed
     */
    public function forceDelete(User $user, Staff $model)
    {
        return false;
    }
}
