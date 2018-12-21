<?php

namespace App\Models\Loan\EMI;

use App\Models\Loan\EMI\Traits\Relationships\LoanEmiProposal;
use App\Models\Loan\EMI\Traits\Relationships\LoanEmiType;
use App\Models\Loan\EMI\Traits\Relationships\LoanEmiUser;
use App\Models\Loan\EMI\Traits\Scopes\LoanEmiSearch;
use App\Traits\SortByTrait;
use App\Traits\Uuids;
use App\Traits\WithTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanEmi extends Model
{
    use Uuids,SoftDeletes;

    /**
     * Using Relationships
     */
    use LoanEmiProposal,LoanEmiType,LoanEmiUser;

    /**
     * Using Scope
     */
    use LoanEmiSearch;


    /*
     * Using for with relationship
     */
    use WithTrait;

    /*
     * add available all relation to this model
     */
    protected $withAvailables = array('type','client','proposal');

    /*
     * Using for sorting fields
     */
    use SortByTrait;

    /**
     * @var array add all fields by which you can do sorting
     */
    protected $sortAvailableFields = array(
        'client_id',
        'loan_proposal_id',
        'loan_type_id',
        'is_paid'.
        'is_enable'.
        'date_of_emi'.
        'is_forget_to_pay'.
        'created_at',
    );

    /*
     * default sorting field
     */
    protected $defaultSortingField = 'created_at';

    /*
     * default sorting type
     */
    protected $defaultSortingType = 'desc';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'loan_proposal_id',
        'loan_type_id',
        'interest_rate',
        'emi_amount',
        'is_paid',
        'is_enable',
        'date_of_emi',
        'is_forget_to_pay',
        'penalty_amount',
    ];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
