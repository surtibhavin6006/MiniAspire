<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 10:42 AM
 */

namespace App\Models\Loan\Proposal\Traits\Relationships;


use App\Models\Loan\Type\LoanType;

trait LoanProposalType
{
    public function type()
    {
        return $this->belongsTo(
            LoanType::class,
            'loan_type_id',
            'id'
        );
    }
}