<?php

namespace App\Http\Controllers\Api\V1\Loan\Emi;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\Loan\Emi\PayEmiRequest;
use App\Http\Requests\Api\V1\Loan\Emi\ViewRequest;
use App\Http\Resources\Api\V1\Loan\Emi\LoanEmiResource;
use App\Http\Resources\Api\V1\Loan\Emi\LoanEmisResource;
use App\Services\Loan\Emi\LoanEmiService;
use Illuminate\Http\Request;

class LoanEmiController extends ApiBaseController
{
    protected $loanEmi;

    /**
     * LoanEmiController constructor.
     * @param LoanEmiService $loanEmi
     */
    public function __construct(LoanEmiService $loanEmi)
    {
        parent::__construct();
        $this->loanEmi = $loanEmi;
    }


    /**
     * @param Request $request
     * @return LoanEmisResource
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

        $loanEmis = $this->loanEmi->index($request);

        return new LoanEmisResource($loanEmis);
    }

    /**
     * @param PayEmiRequest $request
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function show(ViewRequest $request, $id)
    {
        $loanProposal = $this->loanEmi->show($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new LoanEmiResource($loanProposal)
            ]
        );
    }

    /**
     * @param PayEmiRequest $request
     * @param $id
     * @return mixed
     */
    public function emiPay(PayEmiRequest $request, $id)
    {
        $loanProposal = $this->loanEmi->payEmi($id);

        return $this->respond(
            [
                'success' => true,
                'message' => 'Your Emi Successfully Paid',
                'data' => new LoanEmiResource($loanProposal)
            ]
        );
    }
}
