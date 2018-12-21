<?php

namespace App\Http\Resources\Api\V1\Loan\Emi;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanEmisResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return LoanEmiResource::collection($this->collection);
    }

    public function with($request)
    {
        /**
         * Handling to show list of record per page
         */
        $perPage = config('general.pagination.per_page');
        if(!empty($request->per_page)){
            $perPage = $request->per_page;
        }

        /**
         * Default sorting and type
         */

        $sortField = 'created_at';
        $sortType = 'desc';
        if(!empty($request->sort_field)){
            $sortField = $request->sort_field;
        }
        if(!empty($request->sort_type)){
            $sortType = $request->sort_type;
        }


        return [
            'meta'    => [
                'headers' => [
                    'user_id',
                    'loan_proposal_id',
                    'loan_type_id',
                    'interest_rate',
                    'remaining_amount',
                    'emi_amount',
                    'is_paid',
                    'is_enable',
                    'date_of_emi',
                    'is_forget_to_pay',
                    'penalty_amount',
                ],
                'params' => [
                    'available_searches' => [
                        'client_id' => ['type'=>'string'],
                        'loan_proposal_id' => ['type'=>'string'],
                        'loan_type_id' => ['type'=>'string'],
                        'is_paid' => ['type'=>'boolean'],
                        'is_enable' => ['type'=>'boolean'],
                        'is_forget_to_pay' => ['type'=>'boolean'],
                    ],
                    'available_sorts' => [
                        'client_id' => ['asc','desc'],
                        'loan_proposal_id' => ['asc','desc'],
                        'loan_type_id' => ['asc','desc'],
                        'is_paid' => ['asc','desc'],
                        'is_enable' => ['asc','desc'],
                        'date_of_emi' => ['asc','desc'],
                        'is_forget_to_pay' => ['asc','desc'],
                        'created_at' => ['asc','desc'],
                    ],
                    'available_includes' => [
                        'type',
                        'client',
                        'proposal'
                    ],
                    'pagination' => [
                        'per_page' => config('general.pagination.per_page')
                    ]
                ],
                'action_taken' =>[
                    'searches' => [
                        'client_id' => $request->client_id,
                        'loan_proposal_id' => $request->loan_proposal_id,
                        'loan_type_id' => $request->loan_type_id,
                        'is_paid' => $request->is_paid,
                        'is_enable' => $request->is_enable,
                        'is_forget_to_pay' => $request->is_forget_to_pay,
                    ],
                    'includes' => $request->includes,
                    'sorts' => [$sortField,$sortType],
                    'pagination' => [
                        'per_page' => $perPage
                    ]
                ]
            ],
        ];
    }
}
