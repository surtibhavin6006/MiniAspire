<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 11:17 AM
 */

Route::group([
    'middleware' => 'api-auth',
    'namespace' => 'Loan\Emi',
    'prefix' => 'loan',
    'as' => 'loan'
], function(){

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'emis',
        'as' => 'emi.'
    ], function(){
        Route::get('/', 'LoanEmiController@index')->name('list');
    });

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'emi',
        'as' => 'emi.'
    ], function(){
        Route::get('/{id}','LoanEmiController@show')->name('show');
        Route::patch('/{id}','LoanEmiController@update')->name('update');
        Route::patch('/pay/{id}','LoanEmiController@emiPay')->name('emiPay');
    });

});