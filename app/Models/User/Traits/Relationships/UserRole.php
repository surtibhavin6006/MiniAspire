<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 4:08 PM
 */

namespace App\Models\User\Traits\Relationships;


use App\Models\Role\Role;

trait UserRole
{
    public function role(){

        return $this->belongsToMany(
            Role::class,
            'user_role',
            'user_id',
            'role_slug'
        );

    }
}