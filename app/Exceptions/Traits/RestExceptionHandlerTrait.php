<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 9:06 AM
 */

namespace App\Exceptions\Traits;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait RestExceptionHandlerTrait
{
    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch (true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            case $this->isValidationException($e):
                $retval = $this->ValidationExceptionMessage($e);
                break;
            default:
                $message = $e->getMessage();
                if(empty($message)){
                    $message = 'Bad request';
                }

                $statusCode = $e->getCode();
                if(empty($statusCode)){
                    $statusCode = 400;
                }
                $retval = $this->badRequest($message,$statusCode);
        }
        return $retval;
    }
    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message = 'Bad request', $statusCode = 400)
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }
    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message = 'Record not found', $statusCode = 404)
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    protected function ValidationExceptionMessage(&$e, $statusCode = 400)
    {
        $errors  = $e->errors();
        return $this->jsonResponse(['error' => $errors], $statusCode);
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404)
    {
        $payload = $payload ?: [];
        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * @param Exception $e
     * @return bool
     */
    protected function isValidationException(Exception $e)
    {
        return $e instanceof ValidationException;
    }
}