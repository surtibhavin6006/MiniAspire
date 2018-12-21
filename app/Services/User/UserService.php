<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 8:37 AM
 */

namespace App\Services\User;


use App\Interfaces\CrudServiceInterface;
use App\Repository\User\UserRepository;
use Illuminate\Http\Request;

class UserService implements CrudServiceInterface
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user ;
    }

    public function index(Request $request)
    {
        $attributes = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->email,
            'is_email_verified' => $request->is_email_verified,
            'per_page' => $request->per_page,
            'includes' => $request->includes,
            'sort_field' => $request->sort_field,
            'sort_type' => $request->sort_type,
        );

        return $this->user->all($attributes);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'first_name',
            'last_name',
            'email',
            'password',
            'address1',
            'address2',
            'zipcode',
            'mobile_number',
            'gender',
            'user_type'
        ]);

        return $this->user->create($attributes);
    }

    public function show($id,Request $request)
    {
        $attributes = $request->only([
            'includes',
        ]);

        return $this->user->find($id,$attributes);
    }

    public function update($id,Request $request)
    {
        $attributes = $request->only([
            'first_name',
            'last_name',
            'address1',
            'address2',
            'zipcode'
        ]);

        return $this->user->update($id,$attributes);
    }

    public function destroy($id)
    {
        return $this->user->softDelete($id);
    }
}