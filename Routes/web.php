<?php


Route::prefix('companycasabonita')->group(function() 
{
    Route::get('api', 'ApiController@index')->name('companycasabonita.api');

    Route::post('api/all', 'ApiController@storeAll')->name('companycasabonita.api.store.all');
    Route::post('api/{order}', 'ApiController@store')->name('companycasabonita.api.store');
});