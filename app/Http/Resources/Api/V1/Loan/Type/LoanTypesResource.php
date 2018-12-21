<?php

namespace App\Http\Resources\Api\V1\Loan\Type;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanTypesResource extends ResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return LoanTypeResource::collection($this->collection);
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
                    'name',
                    'interest_type',
                    'created_at',
                ],
                'params' => [
                    'available_searches' => [
                        'name' => ['type'=>'string'],
                        'interest_type' => ['type'=>'string'],
                    ],
                    'available_sorts' => [
                        'name' => ['asc','desc'],
                        'interest_type' => ['asc','desc'],
                        'interest_rate' => ['asc','desc'],
                        'created_at' => ['asc','desc'],
                    ],
                    'available_includes' => [

                    ],
                    'pagination' => [
                        'per_page' => config('general.pagination.per_page')
                    ]
                ],
                'action_taken' =>[
                    'searches' => [
                        'name' => $request->name,
                        'interest_type' => $request->interest_type
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
