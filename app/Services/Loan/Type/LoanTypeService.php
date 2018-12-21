<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 6:24 AM
 */

namespace App\Services\Loan\Type;


use App\Interfaces\CrudServiceInterface;
use App\Repository\loan\type\LoanTypeRepository;
use Illuminate\Http\Request;

class LoanTypeService implements CrudServiceInterface
{
    protected $loanType;

    /**
     * LoanTypeService constructor.
     * @param LoanTypeRepository $loanType
     */
    public function __construct(LoanTypeRepository $loanType)
    {
        $this->loanType = $loanType;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $attributes = array(
            'name' => $request->name,
            'interest_type' => $request->interest_type,
            'per_page' => $request->per_page,
            'includes' => $request->includes,
            'sort_field' => $request->sort_field,
            'sort_type' => $request->sort_type,
        );

        return $this->loanType->all($attributes);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $attributes = $request->only([
            'name',
            'interest_type',
            'interest_rate',
        ]);

        return $this->loanType->create($attributes);
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

        return $this->loanType->find($id,$attributes);
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

        return $this->loanType->update($id,$attributes);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($id)
    {
        return $this->loanType->softDelete($id);
    }
}