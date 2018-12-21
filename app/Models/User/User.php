<?php

namespace App\Models\User;

use App\Models\User\Traits\Access\UserAccess;
use App\Models\User\Traits\Relationships\UserRole;
use App\Models\User\Traits\Scopes\UserSearch;
use App\Traits\SortByTrait;
use App\Traits\Uuids;
use App\Traits\WithTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,Uuids,SoftDeletes;

    /**
     * Using Relationships
     */
    use UserRole;

    /**
     * Using Access
     */
    use UserAccess;

    /*
     * Using search in model
     */
    use UserSearch;

    /*
     * Using for with relationship
     */
    use WithTrait;

    /*
     * add available all relation to this model
     */
    protected $withAvailables = array('role');

    /*
     * Using for sorting fields
     */
    use SortByTrait;

    /**
     * @var array add all fields by which you can do sorting
     */
    protected $sortAvailableFields = array(
        'first_name',
        'last_name',
        'email',
        'created_at',
        'email_verified_at'
    );

    /*
     * default sorting field
     */
    protected $defaultSortingField = 'created_at';

    /*
     * default sorting type
     */
    protected $defaultSortingType = 'desc';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
