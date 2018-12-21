<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 10:08 AM
 */

namespace App\Repository\loan\Proposal;


use App\Exceptions\GeneralException;
use App\Interfaces\RepositoryInterface;
use App\Models\Loan\Proposal\LoanProposal;
use Illuminate\Support\Facades\DB;

class LoanProposalRepository implements RepositoryInterface
{
    protected $loanProposal;

    /**
     * LoanProposalRepository constructor.
     * @param LoanProposal $loanProposal
     */
    public function __construct(LoanProposal $loanProposal)
    {
        $this->loanProposal = $loanProposal;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function all(array $attributes = array())
    {
        $isApproved = isset($attributes['is_approved']) ? $attributes['is_approved'] : '';
        $loanTypeId = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : '';
        $userId = !empty($attributes['user_id']) ? $attributes['user_id'] : '';
        $perPage = !empty($attributes['per_page']) ? $attributes['per_page'] : config('general.pagination.per_page');
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();
        $sort_field = !empty($attributes['sort_field']) ? $attributes['sort_field'] : 'created_at';
        $sort_type = !empty($attributes['sort_type']) ? $attributes['sort_type'] : 'desc';

        $data = $this->loanProposal->searchByIsApproved($isApproved)
            ->searchByLoanTypeId($loanTypeId)
            ->searchByUserId($userId)
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
        $loanProposal = new $this->loanProposal;
        $loanProposal->reason = !empty($attributes['reason']) ? $attributes['reason'] : NULL;
        $loanProposal->borrow_amount = !empty($attributes['borrow_amount']) ? $attributes['borrow_amount'] : NULL;
        $loanProposal->loan_type_id = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : NULL;
        $loanProposal->is_approved = isset($attributes['is_approved']) ? $attributes['is_approved'] : NULL;
        $loanProposal->decline_reason = !empty($attributes['decline_reason']) ? $attributes['decline_reason'] : NULL;
        $loanProposal->tenure = !empty($attributes['tenure']) ? $attributes['tenure'] : NULL;
        $loanProposal->user_id = !empty($attributes['client_id']) ? $attributes['client_id'] : NULL;

        $returnData = DB::transaction(function () use (&$loanProposal) {

            if ($loanProposal->save()) {

                return $loanProposal;
            }

            throw new GeneralException('Not able to create Loan Proposal');

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

        $loanProposal = $this->loanProposal->wantByInclude($includes)->find($id);

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
        $loanProposal = $this->find($id);
        $loanProposal->reason = !empty($attributes['reason']) ? $attributes['reason'] : $loanProposal->reason;
        $loanProposal->borrow_amount = !empty($attributes['borrow_amount']) ? $attributes['borrow_amount'] : $loanProposal->borrow_amount;
        $loanProposal->loan_type_id = !empty($attributes['loan_type_id']) ? $attributes['loan_type_id'] : $loanProposal->loan_type_id;
        $loanProposal->is_approved = isset($attributes['is_approved']) ? $attributes['is_approved'] : $loanProposal->is_approved;
        $loanProposal->decline_reason = !empty($attributes['decline_reason']) ? $attributes['decline_reason'] : $loanProposal->decline_reason;

        if(!empty($loanProposal->decline_reason)){
            $loanProposal->decline_reason = NULL;
        }

        $loanProposal->tenure = !empty($attributes['tenure']) ? $attributes['tenure'] : $loanProposal->tenure;
        $loanProposal->user_id = !empty($attributes['client_id']) ? $attributes['client_id'] : $loanProposal->user_id;

        $returnData = DB::transaction(function () use (&$loanProposal) {

            if ($loanProposal->save()) {

                return $loanProposal;
            }

            throw new GeneralException('Not able to update Loan Proposal');

        },config('general.db_transaction.try'));

        return $returnData;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function ApproveDisapprove($id, array $attributes)
    {
        $loanProposal = $this->find($id);

        if($loanProposal->is_approved != ''){
            throw new GeneralException('You have already approved/disapproved proposal');
        }

        $loanProposal->is_approved = isset($attributes['is_approved']) ? $attributes['is_approved'] : $loanProposal->is_approved;

        $returnData = DB::transaction(function () use (&$loanProposal) {

            if ($loanProposal->save()) {

                return $loanProposal;
            }

            throw new GeneralException('Not able to approve Loan Proposal');

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