<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 8:54 AM
 */

namespace App\Interfaces;


interface RepositoryInterface
{
    public function all(array $attributes);

    public function create(array $attributes);

    public function find($id,array $attributes);

    public function update($id,array $attributes);

    public function softDelete($id);

    public function forceDelete($id);

}