<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\User\StoreRequest;
use App\Http\Requests\Api\V1\User\UpdateRequest;
use App\Http\Resources\Api\V1\User\UserProfilePicResource;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Http\Resources\Api\V1\User\UsersResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends ApiBaseController
{
    protected $user;


    /**
     * UserController constructor.
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        parent::__construct();
        $this->user = $user;
    }


    /**
     * @param Request $request
     * @return UsersResource
     */
    public function index(Request $request)
    {
        $users = $this->user->index($request);

        return new UsersResource($users);
    }


    /**
     * @param StoreRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreRequest $request)
    {
        $user = $this->user->store($request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'User Inserted Successfully',
                'data' => new UserResource($user)
            ]
        );

    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function show($id, Request $request)
    {
        $user = $this->user->show($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new UserResource($user)
            ]
        );
    }


    /**
     * @param $id
     * @param UpdateRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update($id, UpdateRequest $request)
    {
        $user = $this->user->update($id,$request);

        return $this->respond(
            [
                'success' => true,
                'data' => new UserResource($user)
            ]
        );


    }


    /**
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($id)
    {
        $this->user->destroy($id);

        return $this->respond(
            [
                'success' => 'true',
                'message' => 'User Deleted Successfully',
            ]
        );
    }

    public function uploadProfilePic($id,Request $request)
    {
        return $_FILES;
        $user = $this->user->update($id,$request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'User Profile Updated Successfully',
                'data' => new UserProfilePicResource($user)
            ]
        );
    }

}
