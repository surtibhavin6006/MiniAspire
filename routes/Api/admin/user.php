<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 19/12/18
 * Time: 7:07 PM
 */


Route::group([
    'middleware' => 'api-auth',
    'namespace' => 'User',
    'prefix' => 'users',
    'as' => 'user.'
], function(){
    Route::get('/', 'UserController@index')->name('list');
});

Route::group([
    'middleware' => 'api-auth',
    'namespace' => 'User',
    'prefix' => 'user',
    'as' => 'user.'
], function(){
    Route::post('/', 'UserController@store')->name('store');
    Route::get('/{id}','UserController@show')->name('show');
    Route::patch('/{id}','UserController@update')->name('update');
    Route::delete('/{id}','UserController@destroy')->name('destroy');
    Route::post('profile-pic/{id}', 'UserController@uploadProfilePic')->name('uploadProfilePic');
});