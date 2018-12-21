<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:45 PM
 */

namespace App\Models\Loan\EMI\Traits\Scopes;


trait LoanEmiSearch
{
    public function scopeSearchByUserId($query,$userId = array())
    {

        if(!empty($userId)){

            if(!is_array($userId)){
                $userId = explode(",",$userId);
            }

            $query->whereIn('user_id',$userId);
        }

        return $query;
    }

    public function scopeSearchByLoanProposalId($query, $loanProposalId = array())
    {
        if(!empty($loanProposalId)){

            if(!is_array($loanProposalId)){
                $loanProposalId = explode(",",$loanProposalId);
            }

            $query->whereIn('loan_proposal_id',$loanProposalId);
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


    public function scopeSearchByEmiIsPaid($query, $isPaid = '')
    {
        if(isset($isPaid) && $isPaid != ''){
            $query->where('is_paid',$isPaid);
        }

        return $query;
    }

    public function scopeSearchByEmiIsEnable($query, $isEnable = '')
    {
        if(isset($isEnable) && $isEnable != ''){
            $query->where('is_enable',$isEnable);
        }

        return $query;
    }

    public function scopeSearchByEmiIsForget($query, $isForgetToPay = '')
    {
        if(isset($isEnable) && $isForgetToPay != ''){
            $query->where('is_forget_to_pay',$isForgetToPay);
        }

        return $query;
    }


}