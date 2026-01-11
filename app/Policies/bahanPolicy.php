<?php

namespace App\Policies;

use App\Models\User;
use App\Models\bahan;
use Illuminate\Auth\Access\Response;

class bahanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
       return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, bahan $bahan): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role === 'admin') {
            return true;
        }else{
           ?>

           <div>
              <script>
                alert("Anda tidak memiliki akses ke halaman ini!");
                window.location.href = "/dashboard"; // Redirect ke halaman dashboard   
                </script>
           </div>

           <?php

           return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, bahan $bahan): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, bahan $bahan): bool
    {
        return $user->role === 'admin';
    }

    public function tambah(User $user, bahan $bahan): bool
    {
        return $user->role === 'admin' || $user->role === '';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, bahan $bahan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, bahan $bahan): bool
    {
        return false;
    }

    public function ambil(User $user, bahan $bahan): bool
    {
        return $user->role === 'pegawai';
    }

    public function retur(User $user, bahan $bahan): bool
    {
        return  $user->role === 'admin';
    }   



    // view laporan di sidebar
    public function viewLaporan(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'pemilik';
    }
}
