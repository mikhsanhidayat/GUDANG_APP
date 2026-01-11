<?php

namespace App\Policies;

use App\Models\User;
use App\Models\product;
use Illuminate\Auth\Access\Response;

class productPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, product $product): bool
    {
        return $user->role === 'admin' ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, product $product): bool
    {
        return $user->role === 'admin';
    }

    public function tambah(User $user, product $product): bool
    {
        return $user->role === 'admin';
    }

        public function ambil(User $user, product $product): bool
        {
            return $user->role === 'pegawai';
        }

    /**
     * Determine whether the user can restore the model.
     */
    public function retur(User $user, product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, product $product): bool
    {
        return false;
    }
}
