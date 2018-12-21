<?php

namespace App\Exceptions;

use App\Exceptions\Traits\RestExceptionHandlerTrait;
use App\Exceptions\Traits\RestTrait;
use Exception;
use Http\Client\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use RestTrait,RestExceptionHandlerTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //AuthorizationException::class,
        //HttpException::class,
        //ModelNotFoundException::class,
        //ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(!$this->isApiCall($request)) {
            return parent::render($request, $exception);
        } else {

            //dd($exception instanceof ModelNotFoundException);
            //dd(get_class($exception));
            return $this->getJsonResponseForException($request, $exception);
        }

    }
}
