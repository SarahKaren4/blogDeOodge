<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function modify(Admin $admin, Admin $adminMod)
    {

        if ($adminMod->hasRole('superadministrator')) {
            return $admin->hasRole('superadministrator');
        }

        return true;
    }
}
