<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 1:47 PM
 */

namespace App\Services\Loan\Emi;


use App\Events\Api\V1\Loan\Emi\EmiPaidEvent;
use App\Interfaces\CrudServiceInterface;
use App\Repository\loan\Emi\LoanEmiRepository;
use Illuminate\Http\Request;

class LoanEmiService implements CrudServiceInterface
{
    protected $loanEmi;

    /**
     * LoanEmiService constructor.
     * @param LoanEmiRepository $loanEmi
     */
    public function __construct(LoanEmiRepository $loanEmi)
    {
        $this->loanEmi = $loanEmi;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $attributes = array(
            'user_id' => $request->client_id,
            'loan_proposal_id' => $request->loan_proposal_id,
            'load_type_id' => $request->load_type_id,
            'is_paid' => $request->is_paid,
            'is_enable' => $request->is_enable,
            'is_forget_to_pay' => $request->is_forget_to_pay,
            'per_page' => $request->per_page,
            'includes' => $request->includes,
            'sort_field' => $request->sort_field,
            'sort_type' => $request->sort_type,
        );

        return $this->loanEmi->all($attributes);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $attributes = $request->only([
            'client_id',
            'loan_proposal_id',
            'load_type_id',
            'emi_amount',
            'is_paid',
            'is_enable',
            'date_of_emi',
            'is_forget_to_pay',
            'penalty_amount',
        ]);

        return $this->loanEmi->create($attributes);
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

        return $this->loanEmi->find($id, $attributes);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update($id, Request $request)
    {
        $attributes = $request->only([
            'name',
            'interest_type',
            'interest_rate',
        ]);

        return $this->loanEmi->update($id, $attributes);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($id)
    {
        return $this->loanEmi->softDelete($id);
    }

    public function payEmi($id)
    {
        $loanEmi = $this->loanEmi->payEmi($id);

        // Todo : Apply logic to trigger payment gateway to money and fire event
        // On failed Payment Failed and on Successful Payment Successful

        event(new EmiPaidEvent($loanEmi));

        return $loanEmi;
    }

    public function applyPenalty($id, Request $request)
    {

    }
}