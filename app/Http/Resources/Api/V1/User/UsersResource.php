<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return UserResource::collection($this->collection);
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
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'address1',
                    'address2',
                    'zipcode',
                    'mobile_number',
                    'gender',
                    'email_verified_at',
                    'created_at',
                ],
                'params' => [
                    'available_searches' => [
                        'first_name' => ['type'=>'string'],
                        'last_name' => ['type'=>'string'],
                        'email' => ['type'=>'string'],
                        'zipcode' => ['type'=>'string'],
                        'email_verified_at' => ['type'=>'boolean'],
                    ],
                    'available_sorts' => [
                        'first_name' => ['asc','desc'],
                        'last_name' => ['asc','desc'],
                        'email' => ['asc','desc'],
                        'email_verified_at' => ['asc','desc'],
                        'created_at' => ['asc','desc'],
                    ],
                    'available_includes' => [
                        'roles'
                    ],
                    'pagination' => [
                        'per_page' => config('general.pagination.per_page')
                    ]
                ],
                'action_taken' =>[
                    'searches' => [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'zipcode' => $request->zipcode,
                        'email_verified_at' => $request->email_verified_at,
                        'created_by' => $request->created_by,
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
