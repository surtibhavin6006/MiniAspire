<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 10:04 AM
 */

namespace App\Exceptions;
use Exception;

class GeneralException extends Exception
{
    public function errorMessage(){

        return response()->json(
            [
                'success'=>'false',
                'errors'=> [
                    'message' => $this->getMessage(),
                    'code'  => $this->getCode()
                ]
            ]
        );

    }
}