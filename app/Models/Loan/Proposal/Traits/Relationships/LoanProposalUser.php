<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 10:42 AM
 */

namespace App\Models\Loan\Proposal\Traits\Relationships;

use App\Models\User\User;

trait LoanProposalUser
{
    public function client()
    {
        return $this->belongsTo(
          User::class,
          'user_id',
          'id'
        );
    }
}