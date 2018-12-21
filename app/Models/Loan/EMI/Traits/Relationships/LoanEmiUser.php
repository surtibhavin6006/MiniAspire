<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:44 PM
 */

namespace App\Models\Loan\EMI\Traits\Relationships;


use App\Models\User\User;

trait LoanEmiUser
{
    function client()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}