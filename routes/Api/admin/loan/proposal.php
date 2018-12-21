<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 20/12/18
 * Time: 11:17 AM
 */

Route::group([
    'middleware' => 'api-auth',
    'namespace' => 'Loan\Proposal',
    'prefix' => 'loan'
], function(){

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'proposals',
        'as' => 'types.'
    ], function(){
        Route::get('/', 'LoanProposalController@index')->name('list');
    });

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'proposal',
        'as' => 'type.'
    ], function(){
        Route::post('/', 'LoanProposalController@store')->name('store');
        Route::get('/{id}','LoanProposalController@show')->name('show');
        Route::patch('/{id}','LoanProposalController@update')->name('update');
        Route::delete('/{id}','LoanProposalController@destroy')->name('destroy');
    });

});