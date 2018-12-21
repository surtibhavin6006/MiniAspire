<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 7:24 PM
 */

namespace App\Models\User\Traits\Scopes;


trait UserSearch
{
    public function scopeSearchByFirstName($query,$firstName)
    {

        if(!empty($firstName)){
            $query->where('first_name','like','%'.$firstName.'%');
        }

        return $query;
    }

    public function scopeSearchByLastName($query,$lastName)
    {

        if(!empty($lastName)){
            $query->where('last_name','like','%'.$lastName.'%');
        }

        return $query;
    }

    public function scopeSearchByEmail($query,$email)
    {

        if(!empty($email)){
            $query->where('email','like','%'.$email.'%');
        }

        return $query;
    }

    public function scopeSearchByZipCode($query,$zipcode)
    {

        if(!empty($zipcode)){
            $query->where('zipcode','like','%'.$zipcode.'%');
        }

        return $query;
    }

    public function scopeSearchByIsEmailVerified($query,$isEmailVerified)
    {

        if(!empty($isEmailVerified)){
            $query->whereNotNull('email_verified_at');
        }

        return $query;
    }

}