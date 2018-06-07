<?php

Route::prefix('v1')->group(function () {

    Route::prefix('destination')->group(function () {
        Route::get('search', 'DestinationController@search');
    });
    Route::resource('destination', 'DestinationController')->except(['create', 'edit']);


    Route::resource('services', 'ServiceController')->except(['create', 'edit']);

    Route::resource('hotel', 'HotelController')->except(['create', 'edit']);

    //Route::resource('rating', 'RatingController')->except(['create', 'edit']);

});