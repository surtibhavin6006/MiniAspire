<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 11:07 AM
 */

namespace App\Models\User\Traits\Access;


trait UserAccess
{
    public function hasPermission($slug)
    {
        return $this->allow($slug);
    }

    public function allow($slug)
    {
        foreach ($this->role as $role) {

            // See if role has all permissions
            if ($role->slug == 'admin') {
                return true;
            }

            // Validate against the Permission table
            foreach ($role->permissions as $perm) {

                if ($perm->slug === trim($slug)) {
                    return true;
                }

            }

        }

        return false;
    }

    public function hasRole($slug)
    {
        foreach ($this->role as $role) {

            if (trim($slug) == trim($role->slug)) {
                return true;
            }
        }

        return false;
    }
}