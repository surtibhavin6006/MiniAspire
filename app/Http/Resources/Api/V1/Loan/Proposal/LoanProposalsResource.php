<?php

namespace App\Http\Resources\Api\V1\Loan\Proposal;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanProposalsResource extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return LoanProposalResource::collection($this->collection);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
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
                    'reason',
                    'documents',
                    'borrow_amount',
                    'load_type_id',
                    'is_approved',
                    'decline_reason',
                    'tenure',
                    'user_id',
                ],
                'params' => [
                    'available_searches' => [
                        'load_type_id' => ['type'=>'string'],
                        'user_id' => ['type'=>'string'],
                        'is_approved' => ['type'=>'boolean'],
                    ],
                    'available_sorts' => [
                        'is_approved' => ['asc','desc'],
                        'tenure' => ['asc','desc'],
                        'user_id' => ['asc','desc'],
                        'created_at' => ['asc','desc'],
                    ],
                    'available_includes' => [
                        'type','client'
                    ],
                    'pagination' => [
                        'per_page' => config('general.pagination.per_page')
                    ]
                ],
                'action_taken' =>[
                    'searches' => [
                        'load_type_id' => $request->load_type_id,
                        'is_approved' => $request->is_approved,
                        'user_id' => $request->user_id
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
