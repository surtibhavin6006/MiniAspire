<?php

Route::group([
    'prefix'  => 'v1',
    'as' => 'api.v1.',
    'namespace' => 'Api\V1',
], function () {

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.'
    ], function(){

        Route::post('login','LoginController@login')->name('login');
        Route::post('sign-up','LoginController@signUp')->name('signUp');

        Route::group([
            'middleware' => 'api-auth'
        ], function(){
            Route::get('logout', 'LoginController@logout')->name('logout');
            Route::get('refresh', 'LoginController@refresh')->name('refresh');
            Route::get('me','LoginController@me')->name('me');
            Route::patch('update-profile/{id}','LoginController@updateProfile')->name('updateProfile');
        });

    });

    Route::group([
        'middleware' => 'api-auth'
    ], function () {
        includeRouteFiles(__DIR__.'/Api/');
    });

});
