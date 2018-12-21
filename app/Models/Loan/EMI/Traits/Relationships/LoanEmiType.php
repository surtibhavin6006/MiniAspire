<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:45 PM
 */

namespace App\Models\Loan\EMI\Traits\Relationships;


use App\Models\Loan\Type\LoanType;

trait LoanEmiType
{
    function type()
    {
        return $this->belongsTo(
            LoanType::class,
            'loan_type_id',
            'id'
        );
    }
}