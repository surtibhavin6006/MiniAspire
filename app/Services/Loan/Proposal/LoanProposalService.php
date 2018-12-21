<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 10:51 AM
 */

namespace App\Services\Loan\Proposal;


use App\Events\Api\V1\Loan\Proposal\ProposalVerifiedEvent;
use App\Interfaces\CrudServiceInterface;
use App\Repository\loan\Proposal\LoanProposalRepository;
use Illuminate\Http\Request;

class LoanProposalService implements CrudServiceInterface
{
    protected $loanProposal;

    /**
     * LoanTypeService constructor.
     * @param LoanTypeRepository $loanType
     */
    public function __construct(LoanProposalRepository $loanProposal)
    {
        $this->loanProposal = $loanProposal;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $attributes = array(
            'is_approved' => $request->is_approved,
            'loan_type_id' => $request->loan_type_id,
            'user_id' => $request->client_id,
            'per_page' => $request->per_page,
            'includes' => $request->includes,
            'sort_field' => $request->sort_field,
            'sort_type' => $request->sort_type,
        );

        return $this->loanProposal->all($attributes);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $attributes = $request->only([
            'reason',
            'documents',
            'borrow_amount',
            'loan_type_id',
            'is_approved',
            'decline_reason',
            'tenure',
            'client_id'
        ]);

        if(empty($attributes['client_id'])){
            $attributes['client_id'] = $request->user()->id;
        }

        $loanProposal = $this->loanProposal->create($attributes);


        /**
         * Firing event to send notification to Admin,User
         */
        if(!empty($loanProposal)){
            event(new ProposalVerifiedEvent($loanProposal));
        }

        return $loanProposal;
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function show($id, Request $request)
    {
        $attributes = $request->only([
            'includes',
        ]);

        return $this->loanProposal->find($id,$attributes);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update($id, Request $request)
    {
        return array();
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function ApproveDisapprove($id, Request $request)
    {
        $attributes = $request->only([
            'is_approved',
            'decline_reason'
        ]);

        $loanProposal = $this->loanProposal->ApproveDisapprove($id,$attributes);

        if(!empty($loanProposal->is_approved)){
            event(new ProposalVerifiedEvent($loanProposal));
        }

        return $loanProposal;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($id)
    {
        return $this->loanProposal->softDelete($id);
    }
}