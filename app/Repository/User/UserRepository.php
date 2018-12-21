<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 8:53 AM
 */

namespace App\Repository\User;


use App\Exceptions\GeneralException;
use App\Interfaces\RepositoryInterface;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements RepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all(array $attributes = array())
    {
        $firstName = !empty($attributes['first_name']) ? $attributes['first_name'] : '';
        $lastName = !empty($attributes['last_name']) ? $attributes['last_name'] : '';
        $email = !empty($attributes['email']) ? $attributes['email'] : '';
        $zipcode = !empty($attributes['zipcode']) ? $attributes['zipcode'] : '';
        $isEmailVerified = !empty($attributes['is_email_verified']) ? $attributes['is_email_verified'] : '';
        $perPage = !empty($attributes['per_page']) ? $attributes['per_page'] : config('general.pagination.per_page');
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();
        $sort_field = !empty($attributes['sort_field']) ? $attributes['sort_field'] : 'created_at';
        $sort_type = !empty($attributes['sort_type']) ? $attributes['sort_type'] : 'desc';
        /*$selectFields = !empty($attributes['select_fields']) ? $attributes['select_fields'] : '*';*/

        $data = $this->user->searchByFirstName($firstName)
                            ->searchByLastName($lastName)
                            ->searchByEmail($email)
                            ->searchByZipCode($zipcode)
                            ->searchByIsEmailVerified($isEmailVerified)
                            ->wantByInclude($includes)
                            ->customOrderBy($sort_field, $sort_type);

        if ($perPage == 'all') {
            return $data->get();
        } else {
            return $data->paginate($perPage);
        }

    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $user = new $this->user;
        $user->first_name = !empty($attributes['first_name']) ? $attributes['first_name'] : NULL;
        $user->last_name = !empty($attributes['last_name']) ? $attributes['last_name'] : NULL;
        $user->password = !empty($attributes['password']) ? bcrypt($attributes['password']) : NULL;
        $user->email = !empty($attributes['email']) ? $attributes['email'] : NULL;
        $user->address1 = !empty($attributes['address1']) ? $attributes['address1'] : NULL;
        $user->address2 = !empty($attributes['address2']) ? $attributes['address2'] : NULL;
        $user->zipcode = !empty($attributes['zipcode']) ? $attributes['zipcode'] : NULL;
        $user->mobile_number = !empty($attributes['mobile_number']) ? $attributes['mobile_number'] : NULL;
        $user->gender = !empty($attributes['gender']) ? $attributes['gender'] : NULL;

        $userType = !empty($attributes['user_type']) ? $attributes['user_type'] : NULL;

        $returnData = DB::transaction(function () use (&$user,&$userType) {

            if ($user->save()) {

                if(!empty($userType)){
                    $user->role()->attach($userType);
                }

                return $user;
            }

            throw new GeneralException('Not able to create User');

        },config('general.db_transaction.try'));

        return $returnData;
    }


    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function find($id, array $attributes = array())
    {
        $includes = !empty($attributes['includes']) ? $attributes['includes'] : array();

        $user = $this->user->wantByInclude($includes)->find($id);

        if(!$user){
            throw new GeneralException('Record Not Found.',404);
        }

        return $user;
    }


    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws GeneralException
     */
    public function update($id, array $attributes = array())
    {
        $user = $this->find($id);

        $user->first_name = !empty($attributes['first_name']) ? $attributes['first_name'] : $user->first_name;
        $user->last_name = !empty($attributes['last_name']) ? $attributes['last_name'] : $user->last_name;
        $user->address1 = !empty($attributes['address1']) ? $attributes['address1'] : $user->address1;
        $user->address2 = !empty($attributes['address2']) ? $attributes['address2'] : $user->address2;
        $user->zipcode = !empty($attributes['zipcode']) ? $attributes['zipcode'] : $user->zipcode;
        $user->email_verified_at = !empty($attributes['email_verified_at']) ? $attributes['email_verified_at'] : $user->email_verified_at;

        $returnData = DB::transaction(function () use (&$user) {

            if ($user->save()) {

                return $user;
            }

            throw new GeneralException('Not able to create User');

        },config('general.db_transaction.try'));

        return $returnData;
    }


    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function softDelete($id)
    {
        return $this->find($id)->delete();
    }


    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function forceDelete($id)
    {
        return $this->find($id)->delete();
    }
}