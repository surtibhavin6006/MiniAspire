<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:44 PM
 */

namespace App\Models\Loan\EMI\Traits\Relationships;


use App\Models\Loan\Proposal\LoanProposal;

trait LoanEmiProposal
{
    function proposal()
    {
        return $this->belongsTo(
            LoanProposal::class,
            'loan_type_id',
            'id'
        );
    }
}