<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    public $guard_name = 'admin';

}
