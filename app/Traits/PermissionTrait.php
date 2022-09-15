<?php

namespace App\Traits;

use App\Models\Permission;

trait PermissionTrait
{

    /**
     * Get permissions of role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
