<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;

class Policy
{

    public function check_permission($admin, $permission_name)
    {
        return $admin->permissions->firstWhere('name', $permission_name)
                ? Response::allow()
                : Response::deny('You do not permission for this action.');
    }

}

