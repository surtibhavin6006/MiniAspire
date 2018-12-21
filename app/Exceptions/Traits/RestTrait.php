<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 9:08 AM
 */

namespace App\Exceptions\Traits;


use Illuminate\Http\Request;

trait RestTrait
{
    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/apix/v1') !== false;
    }
}