<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 9:07 AM
 */

namespace App\Models\Loan\Type\Traits\Scopes;


trait LoanTypeSearch
{
    /**
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeSearchByName($query, $name)
    {

        if(!empty($name)){
            $query->where('name','like','%'.$name.'%');
        }

        return $query;
    }

    /**
     * @param $query
     * @param $interest_type
     * @return mixed
     */
    public function scopeSearchByInterestType($query, $interest_type)
    {

        if(!empty($interest_type)){
            $query->where('interest_type','like','%'.$interest_type.'%');
        }

        return $query;
    }

}