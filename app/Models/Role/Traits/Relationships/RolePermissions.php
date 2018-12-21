<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 11:10 AM
 */

namespace App\Models\Role\Traits\Relationships;


use App\Models\Permission\Permission;

trait RolePermissions
{
    public function permissions()
    {
        $this->belongsToMany(
          Permission::class,
          'role_permissions',
          'role_slug',
          'permission_slug'
        );
    }
}