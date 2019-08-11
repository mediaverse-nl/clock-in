<?php

namespace App\Policies;

use App\User;
use App\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the userRole.
     *
     * @param  \App\User  $user
     * @param  \App\UserRole  $userRole
     * @return mixed
     */
    public function view(User $user, UserRole $userRole)
    {
        //
    }

    /**
     * Determine whether the user can create userRoles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the userRole.
     *
     * @param  \App\User  $user
     * @param  \App\UserRole  $userRole
     * @return mixed
     */
    public function update(User $user, UserRole $userRole)
    {
        //
    }

    /**
     * Determine whether the user can delete the userRole.
     *
     * @param  \App\User  $user
     * @param  \App\UserRole  $userRole
     * @return mixed
     */
    public function delete(User $user, UserRole $userRole)
    {
        //
    }
}
