<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 8:38 AM
 */

namespace App\Interfaces;


use Illuminate\Http\Request;

interface CrudServiceInterface
{
    public function index(Request $request);

    public function store(Request $request);

    public function show($id,Request $request);

    public function update($id,Request $request);

    public function destroy($id);
}