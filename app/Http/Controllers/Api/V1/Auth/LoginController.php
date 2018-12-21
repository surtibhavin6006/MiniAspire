<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\Auth\LoginFormRequest;
use App\Http\Requests\Api\V1\Auth\SingupFormRequest;
use App\Http\Requests\Api\V1\Auth\UpdateProfileFormRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Models\User\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends ApiBaseController
{
    protected $user;

    /**
     * LoginController constructor.
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * @param LoginFormRequest $request
     * @return mixed
     */
    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('email','password');

        $token = $this->getToken($credentials);

        if($token){

            return $this->respond(
                [
                    'success' => 'true',
                    'message' => 'Logged In Successfully',
                    'data' => array(
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => $this->guard->factory()->getTTL() * 60
                    )
                ]
            );

        }

        return $this->respondWithError('Please Enter Valid Email and Password',401);
    }

    /**
     * @param SingupFormRequest $request
     * @return mixed
     */
    public function signUp(SingupFormRequest $request)
    {
        /**
         * Adding user role to client as it is singing up
         */
        $request->request->add(['user_type' => 'client']);
        $user = $this->user->store($request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'User Registered Successfully',
                'data' => new UserResource($user)
            ]
        );
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        return $this->respond(
            [
                'success' => 'true',
                'data' => new UserResource($request->user()),
            ]
        );
    }


    public function updateProfile($id,UpdateProfileFormRequest $request)
    {
        $user = $this->user->update($id,$request);

        return $this->respond(
            [
                'success' => true,
                'message' => 'Profile Updated Successfully',
                'data' => new UserResource($user)
            ]
        );

    }

    /**
     * @return mixed
     */
    public function refresh()
    {
        return $this->respond(
            [
                'success' => 'true',
                'message' => 'Refreshed Successfully',
                'data' => array(
                    'access_token' => $this->guard->refresh(),
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard->factory()->getTTL() * 60
                )
            ]
        );

    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->guard->logout(true);

        return $this->respond(
            [
                'success' => 'true',
                'message' => 'Successfully Logout'
            ]
        );
    }
}
