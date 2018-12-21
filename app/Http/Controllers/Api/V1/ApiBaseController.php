<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ApiBaseController extends Controller
{
    public $guard;

    /**
     * ApiBaseController constructor.
     */
    public function __construct()
    {
        $this->guard = $this->guard();
    }


    /**
     * Get the guard to be used during authentication
     * @param string $guard
     * @return mixed
     */
    public function guard($guard = 'api')
    {
        return Auth::guard($guard);
    }

    /**
     * @param $credentials
     * @return bool
     */
    public function getToken($credentials)
    {
        if($token = $this->guard->attempt($credentials)){
            return $token;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $data
     * @param integer $statusCode
     * @return mixed
     */
    public function respond($data,$statusCode = 200){

        return Response::json(
            $data,
            $statusCode
        );
    }

    /**
     * @param string $message
     * @param integer $statusCode
     * @return mixed
     */
    public function respondWithError($message,$statusCode = 200){


        return Response::json(
            [
                'error'=> [
                    'message' => $message
                ]
            ],
            $statusCode
        );
    }
}
