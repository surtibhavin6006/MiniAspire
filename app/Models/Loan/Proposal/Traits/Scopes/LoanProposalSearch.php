<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 10:21 AM
 */

namespace App\Models\Loan\Proposal\Traits\Scopes;


trait LoanProposalSearch
{
    public function scopeSearchByIsApproved($query,$isApproved = '')
    {

        if(isset($isApproved) && $isApproved != ''){

            $query->where('is_approved',$isApproved);
        }

        return $query;
    }

    public function scopeSearchByLoanTypeId($query,$loanTypeId = array())
    {

        if(!empty($loanTypeId)){

            if(!is_array($loanTypeId)){
                $loanTypeId = explode(",",$loanTypeId);
            }

            $query->whereIn('load_type_id',$loanTypeId);
        }

        return $query;
    }

    public function scopeSearchByUserId($query, $userId = array())
    {
        if(!empty($userId)){

            if(!is_array($userId)){
                $userId = explode(",",$userId);
            }

            $query->whereIn('user_id',$userId);
        }

        return $query;
    }
}