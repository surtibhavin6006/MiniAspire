<?php

Route::group([
    'middleware' => 'api-auth',
    'namespace' => 'Loan\Type',
    'prefix' => 'loan'
], function(){

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'types',
        'as' => 'types.'
    ], function(){
        Route::get('/', 'LoanTypeController@index')->name('list');
    });

    Route::group([
        'middleware' => 'api-auth',
        'prefix' => 'type',
        'as' => 'type.'
    ], function(){
        Route::post('/', 'LoanTypeController@store')->name('store');
        Route::get('/{id}','LoanTypeController@show')->name('show');
        Route::patch('/{id}','LoanTypeController@update')->name('update');
        Route::delete('/{id}','LoanTypeController@destroy')->name('destroy');
    });

});

