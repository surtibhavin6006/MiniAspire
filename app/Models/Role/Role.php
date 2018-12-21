<?php

namespace App\Models\Role;

use App\Models\Role\Traits\Relationships\RolePermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    /**
     * User Relationships
     */
    use RolePermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /*
     * Define primary key
     */
    protected $primaryKey = 'slug';

    /*
     * Define primary key
     */
    public $incrementing = false;
}
