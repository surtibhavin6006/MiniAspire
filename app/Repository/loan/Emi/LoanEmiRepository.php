<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:47 PM
 */

namespace App\Repository\loan\Emi;


use App\Exceptions\GeneralException;
use App\Interfaces\RepositoryInterface;
use App\Models\Loan\EMI\LoanEmi;
use Illuminate\Support\Facades\DB;

class LoanEmiRepository implements RepositoryInterface
{

    protected $loanEmi;

    /**
     * LoanEmiRepository constructor.
     * @param LoanEmi $loanEmi
     */
    public function __construct(LoanEmi $loanEmi)
    {
        $this->loanEmi = $loanEmi;
    }


    /**
     * @param array $attributes
     * @return mixed
     */
    public function all(array $attributes)
    {
        $userId = !empty($attributes['user_id']) ? $attributes['user_id'] : '';
        $loanProposalId = !empty($attributes['loan_proposal_id']) ? $attributes['loan_proposal_id'] : '';
        $loanTypeId = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : '';
        $isEmiPaid = !empty($attributes['is_paid']) ? $attributes['is_paid'] : '';
        $isEmiEnable = !empty($attributes['is_enable']) ? $attributes['is_enable'] : '';
        $isEmiForgetToPay = !empty($attributes['is_forget_to_pay']) ? $attributes['is_forget_to_pay'] : '';
        $perPage = !empty($attributes['per_page']) ? $attributes['per_page'] : config('general.pagination.per_page');
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();
        $sort_field = !empty($attributes['sort_field']) ? $attributes['sort_field'] : 'created_at';
        $sort_type = !empty($attributes['sort_type']) ? $attributes['sort_type'] : 'desc';

        $data = $this->loanEmi->searchByUserId($userId)
            ->searchByLoanProposalId($loanProposalId)
            ->searchByLoanTypeId($loanTypeId)
            ->searchByEmiIsPaid($isEmiPaid)
            ->searchByEmiIsEnable($isEmiEnable)
            ->searchByEmiIsForget($isEmiForgetToPay)
            ->wantByInclude($includes)
            ->customOrderBy($sort_field, $sort_type);

        if ($perPage == 'all') {
            return $data->get();
        } else {
            return $data->paginate($perPage);
        }
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $loanEmi = new $this->loanEmi;
        $loanEmi->user_id = !empty($attributes['client_id']) ? $attributes['client_id'] : NULL;
        $loanEmi->loan_proposal_id = !empty($attributes['loan_proposal_id']) ? $attributes['loan_proposal_id'] : NULL;
        $loanEmi->loan_type_id = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : NULL;
        $loanEmi->interest_rate = !empty($attributes['interest_rate']) ? $attributes['interest_rate'] : NULL;
        $loanEmi->remaining_amount = !empty($attributes['remaining_amount']) ? $attributes['remaining_amount'] : NULL;
        $loanEmi->emi_amount = !empty($attributes['emi_amount']) ? $attributes['emi_amount'] : NULL;
        $loanEmi->is_paid = !empty($attributes['is_paid']) ? $attributes['is_paid'] : NULL;
        $loanEmi->is_enable = !empty($attributes['is_enable']) ? $attributes['is_enable'] : NULL;
        $loanEmi->date_of_emi = !empty($attributes['date_of_emi']) ? $attributes['date_of_emi'] : NULL;
        $loanEmi->is_forget_to_pay = !empty($attributes['is_forget_to_pay']) ? $attributes['is_forget_to_pay'] : NULL;
        $loanEmi->penalty_amount = !empty($attributes['penalty_amount']) ? $attributes['penalty_amount'] : NULL;


        $returnData = DB::transaction(function () use (&$loanEmi) {

            if ($loanEmi->save()) {

                return $loanEmi;
            }

            throw new GeneralException('Not able to create Loan Emi');

        },config('general.db_transaction.try'));

        return $returnData;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function find($id, array $attributes = array())
    {
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();

        $loanProposal = $this->loanEmi->wantByInclude($includes)->find($id);

        if(!$loanProposal){
            throw new GeneralException('Record Not Found.',404);
        }

        return $loanProposal;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function update($id, array $attributes)
    {
        $loanEmi = $this->find($id);
        $loanEmi->user_id = !empty($attributes['client_id']) ? $attributes['client_id'] : $loanEmi->user_id;
        $loanEmi->loan_proposal_id = !empty($attributes['loan_proposal_id']) ? $attributes['loan_proposal_id'] : $loanEmi->loan_proposal_id;
        $loanEmi->loan_type_id = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : $loanEmi->loan_type_id;
        $loanEmi->interest_rate = !empty($attributes['interest_rate']) ? $attributes['interest_rate'] : $loanEmi->interest_rate;
        $loanEmi->remaining_amount = !empty($attributes['remaining_amount']) ? $attributes['remaining_amount'] : $loanEmi->remaining_amount;
        $loanEmi->emi_amount = !empty($attributes['emi_amount']) ? $attributes['emi_amount'] : $loanEmi->emi_amount;
        $loanEmi->is_paid = !empty($attributes['is_paid']) ? $attributes['is_paid'] : $loanEmi->is_paid;
        $loanEmi->is_enable = !empty($attributes['is_enable']) ? $attributes['is_enable'] : $loanEmi->is_enable;
        $loanEmi->date_of_emi = !empty($attributes['date_of_emi']) ? $attributes['date_of_emi'] : $loanEmi->date_of_emi;
        $loanEmi->is_forget_to_pay = !empty($attributes['is_forget_to_pay']) ? $attributes['is_forget_to_pay'] : $loanEmi->is_forget_to_pay;
        $loanEmi->penalty_amount = !empty($attributes['penalty_amount']) ? $attributes['penalty_amount'] : $loanEmi->penalty_amount;


        $returnData = DB::transaction(function () use (&$loanEmi) {

            if ($loanEmi->save()) {

                return $loanEmi;
            }

            throw new GeneralException('Not able to update Loan Emi');

        },config('general.db_transaction.try'));

        return $returnData;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function payEmi($id, array $attributes = array())
    {
        $loanEmi = $this->find($id);

        if(!empty($loanEmi->is_paid)){
            throw new GeneralException('You have already paid');
        }

        $loanEmi->is_paid = 1;

        $returnData = DB::transaction(function () use (&$loanEmi) {

            if ($loanEmi->save()) {

                return $loanEmi;
            }

            throw new GeneralException('Not able to pay Loan Emi');

        },config('general.db_transaction.try'));

        return $returnData;
    }

    public function applyPenalty($id,array $attributes)
    {
        $loanEmi = $this->find($id);
        $loanEmi->is_paid = !empty($attributes['is_paid']) ? $attributes['is_paid'] : $loanEmi->is_paid;
        $loanEmi->is_forget_to_pay = !empty($attributes['is_forget_to_pay']) ? $attributes['is_forget_to_pay'] : $loanEmi->is_forget_to_pay;
        $loanEmi->penalty_amount = !empty($attributes['penalty_amount']) ? $attributes['penalty_amount'] : $loanEmi->penalty_amount;

        $returnData = DB::transaction(function () use (&$loanEmi) {

            if ($loanEmi->save()) {

                return $loanEmi;
            }

            throw new GeneralException('Not able to apply panelty on Loan Emi');

        },config('general.db_transaction.try'));

        return $returnData;
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function softDelete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function forceDelete($id)
    {
        return $this->find($id)->delete();
    }
}