<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 6:26 AM
 */

namespace App\Repository\loan\type;


use App\Exceptions\GeneralException;
use App\Interfaces\RepositoryInterface;
use App\Models\Loan\Type\LoanType;
use Illuminate\Support\Facades\DB;

class LoanTypeRepository implements RepositoryInterface
{
    protected $loanType;

    /**
     * LoanTypeRepository constructor.
     * @param LoanType $loanType
     */
    public function __construct(LoanType $loanType)
    {
        $this->loanType = $loanType;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function all(array $attributes = array())
    {
        $name = !empty($attributes['name']) ? $attributes['name'] : '';
        $interestType = !empty($attributes['interest_type']) ? $attributes['interest_type'] : '';
        $perPage = !empty($attributes['per_page']) ? $attributes['per_page'] : config('general.pagination.per_page');
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();
        $sort_field = !empty($attributes['sort_field']) ? $attributes['sort_field'] : 'created_at';
        $sort_type = !empty($attributes['sort_type']) ? $attributes['sort_type'] : 'desc';

        $data = $this->loanType->searchByName($name)
            ->searchByInterestType($interestType)
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
        $loanType = new $this->loanType;
        $loanType->name = !empty($attributes['name']) ? $attributes['name'] : NULL;
        $loanType->interest_type = !empty($attributes['interest_type']) ? $attributes['interest_type'] : NULL;
        $loanType->interest_rate = !empty($attributes['interest_rate']) ? $attributes['interest_rate'] : NULL;
        $loanType->penalty_amount = !empty($attributes['penalty_amount']) ? $attributes['penalty_amount'] : NULL;

        $returnData = DB::transaction(function () use (&$loanType) {

            if ($loanType->save()) {

                return $loanType;
            }

            throw new GeneralException('Not able to create Loan type');

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

        $loanType = $this->loanType->wantByInclude($includes)->find($id);

        if(!$loanType){
            throw new GeneralException('Record Not Found.',404);
        }

        return $loanType;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function update($id, array $attributes)
    {
        $loanType = $this->find($id);
        $loanType->name = !empty($attributes['name']) ? $attributes['name'] : $loanType->name;
        $loanType->interest_type = !empty($attributes['interest_type']) ? $attributes['interest_type'] : $loanType->interest_type;
        $loanType->interest_rate = !empty($attributes['interest_rate']) ? $attributes['interest_rate'] : $loanType->interest_rate;
        $loanType->penalty_amount = !empty($attributes['penalty_amount']) ? $attributes['penalty_amount'] : $loanType->penalty_amount;

        $returnData = DB::transaction(function () use (&$loanType) {

            if ($loanType->save()) {

                return $loanType;
            }

            throw new GeneralException('Not able to update Loan type');

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