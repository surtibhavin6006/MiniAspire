<?php

namespace App\Http\Controllers\Api\V1\Loan\Type;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\Loan\Type\DestroyRequest;
use App\Http\Requests\Api\V1\Loan\Type\StoreRequest;
use App\Http\Requests\Api\V1\Loan\Type\UpdateRequest;
use App\Http\Requests\Api\V1\Loan\Type\ViewRequest;
use App\Http\Resources\Api\V1\Loan\Type\LoanTypeResource;
use App\Http\Resources\Api\V1\Loan\Type\LoanTypesResource;
use App\Services\Loan\Type\LoanTypeService;
use Illuminate\Http\Request;

class LoanTypeController extends ApiBaseController
{
    protected $loanType;

    /**
     * LoanTypeController constructor.
     * @param LoanTypeService $loanType
     */
    public function __construct(LoanTypeService $loanType)
    {
        $this->loanType = $loanType;
    }


    /**
     * @param Request $request
     * @return LoanTypesResource
     */
    public function index(Request $request)
    {
        $loanTypes = $this->loanType->index($request);

        return new LoanTypesResource($loanTypes);
    }


    /**
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $loanType = $this->loanType->store($request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'Loan Type Inserted Successfully',
                'data' => new LoanTypeResource($loanType)
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
        $loanType = $this->loanType->show($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new LoanTypeResource($loanType)
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
        $loanType = $this->loanType->update($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new LoanTypeResource($loanType)
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
        $this->loanType->destroy($id);

        return $this->respond(
            [
                'success' => 'true',
                'message' => 'Loan Type Deleted Successfully',
            ]
        );
    }
}
