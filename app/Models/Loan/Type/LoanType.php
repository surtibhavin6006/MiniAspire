<?php

namespace App\Models\Loan\Type;

use App\Models\Loan\Type\Traits\Scopes\LoanTypeSearch;
use App\Traits\SortByTrait;
use App\Traits\Uuids;
use App\Traits\WithTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanType extends Model
{
    use Uuids,SoftDeletes;

    /*
     * Using search in model
     */
    use LoanTypeSearch;

    /*
     * Using for with relationship
     */
    use WithTrait;

    /*
     * add available all relation to this model
     */
    protected $withAvailables = array();

    /*
     * Using for sorting fields
     */
    use SortByTrait;

    /**
     * @var array add all fields by which you can do sorting
     */
    protected $sortAvailableFields = array(
        'name',
        'interest_type',
        'interest_rate',
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
        'name', 'interest_type', 'interest_rate'
    ];


    protected $dates = [
        'created_at','updated_at','deleted_at'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
