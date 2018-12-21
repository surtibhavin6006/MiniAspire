<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

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
