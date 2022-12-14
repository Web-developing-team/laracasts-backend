<?php

namespace App\Traits;

use App\Models\Permission;

trait PermissionTrait
{

    /**
     * Get permissions of model => user or admin .
     *
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
