<?php

namespace App\Http\Resources\Api\V1\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RolesResource extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return RoleResource::collection($this->collection);
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
                    'slug',
                    'created_at',
                ],
                'params' => [
                    'available_searches' => [
                        'name' => ['type'=>'string'],
                    ],
                    'available_sorts' => [
                        'name' => ['asc','desc'],
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
                        'name' => $request->name
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
