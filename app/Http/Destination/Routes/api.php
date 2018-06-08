<?php

Route::prefix('v1')->group(function () {

    Route::prefix('destination')->group(function () {
        Route::get('search', 'DestinationController@search');
    });
    Route::resource('destination', 'DestinationController')->except(['create', 'edit']);

    Route::prefix('service')->group(function () {
        Route::get('search', 'ServiceController@search');
    });
    Route::resource('service', 'ServiceController')->except(['create', 'edit']);

    Route::prefix('hotel')->group(function () {
        Route::get('search', 'HotelController@search');
    });
    Route::resource('hotel', 'HotelController')->except(['create', 'edit']);

    //Route::resource('rating', 'RatingController')->except(['create', 'edit']);

});