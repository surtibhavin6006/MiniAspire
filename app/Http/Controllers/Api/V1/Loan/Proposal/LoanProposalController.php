<?php

namespace App\Http\Controllers\Api\V1\Loan\Proposal;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\Loan\Proposal\DestroyRequest;
use App\Http\Requests\Api\V1\Loan\Proposal\StoreRequest;
use App\Http\Requests\Api\V1\Loan\Proposal\UpdateRequest;
use App\Http\Requests\Api\V1\Loan\Proposal\ViewRequest;
use App\Http\Resources\Api\V1\Loan\Proposal\LoanProposalResource;
use App\Http\Resources\Api\V1\Loan\Proposal\LoanProposalsResource;
use App\Services\Loan\Proposal\LoanProposalService;
use Illuminate\Http\Request;

class LoanProposalController extends ApiBaseController
{
    protected $loanProposal;

    public function __construct(LoanProposalService $loanProposal)
    {
        parent::__construct();
        $this->loanProposal = $loanProposal;
    }


    /**
     * @param Request $request
     * @return LoanProposalsResource
     */
    public function index(Request $request)
    {
        /**
         * if user type is client,we will remove client_id if passed and add logged in user id
         */
        if($request->user()->hasRole('client')){
            $request->request->remove('client_id');
            $request->request->add(['client_id'=>$request->user()->id]);
        }

        $loanProposals = $this->loanProposal->index($request);

        return new LoanProposalsResource($loanProposals);
    }

    /**
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        /**
         * if user type is client,we will remove client_id if passed and add logged in user id
         */
        if($request->user()->hasRole('client')){
            $request->request->remove('client_id');
            $request->request->add(['client_id'=>$request->user()->id]);
        }

        $loanProposal = $this->loanProposal->store($request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'Loan Proposal Inserted Successfully',
                'data' => new LoanProposalResource($loanProposal)
            ]
        );
    }


    /**
     * @param ViewRequest $request
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function show(ViewRequest $request, $id)
    {
        $loanProposal = $this->loanProposal->show($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new LoanProposalResource($loanProposal)
            ]
        );
    }


    /**
     * @param UpdateRequest $request
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateRequest $request, $id)
    {
        $loanProposal = $this->loanProposal->ApproveDisapprove($id,$request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'You have approved Proposal',
                'data' => new LoanProposalResource($loanProposal)
            ]
        );
    }


    /**
     * @param DestroyRequest $request
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->loanProposal->destroy($id);

        return $this->respond(
            [
                'success' => 'true',
                'message' => 'Loan Type Deleted Successfully',
            ]
        );
    }
}
