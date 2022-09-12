<?php

namespace App\Traits;

use App\Models\User;

trait PermissionTrait
{

    /**
     * Get permissions of role.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
