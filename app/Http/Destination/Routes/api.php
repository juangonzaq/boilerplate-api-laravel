<?php

Route::prefix('destination')->group(function () {

    Route::resource('/', 'DestinationController')->only(['index', 'show', 'store', 'update', 'destroy']);

    Route::prefix('services')->group(function () {
        Route::resource('/', 'ServiceController')->only(['index', 'show', 'store', 'update', 'destroy']);
    });

    Route::prefix('hotel')->group(function () {
        Route::resource('/', 'HotelController')->only(['index', 'show', 'store', 'update', 'destroy']);
    });

    Route::prefix('rating')->group(function () {
        Route::resource('/', 'RatingController')->only(['index', 'show', 'store', 'update', 'destroy']);
    });

});