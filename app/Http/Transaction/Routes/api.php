<?php

Route::prefix('v1')->group(function () {
    Route::prefix('transaction')->group(function () {
        Route::post('/user', 'TransactionUserController@store');
    });
    Route::resource('transaction', 'TransactionController')->except(['create', 'edit']);
});