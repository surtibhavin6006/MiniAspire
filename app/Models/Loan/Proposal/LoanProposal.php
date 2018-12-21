<?php

namespace App\Models\Loan\Proposal;

use App\Models\Loan\Proposal\Traits\Relationships\LoanProposalType;
use App\Models\Loan\Proposal\Traits\Relationships\LoanProposalUser;
use App\Models\Loan\Proposal\Traits\Scopes\LoanProposalSearch;
use App\Traits\SortByTrait;
use App\Traits\Uuids;
use App\Traits\WithTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanProposal extends Model
{
    use Uuids,SoftDeletes;

    /**
     * Using Relationships
     */
    use LoanProposalUser,LoanProposalType;

    /**
     * Using Scope
     */
    use LoanProposalSearch;


    /*
     * Using for with relationship
     */
    use WithTrait;

    /*
     * add available all relation to this model
     */
    protected $withAvailables = array('type','client');

    /*
     * Using for sorting fields
     */
    use SortByTrait;

    /**
     * @var array add all fields by which you can do sorting
     */
    protected $sortAvailableFields = array(
        'is_approved',
        'tenure',
        'user_id',
        'created_at'
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
        'reason',
        'documents',
        'borrow_amount',
        'loan_type_id',
        'is_approved',
        'decline_reason',
        'tenure',
        'user_id'
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
