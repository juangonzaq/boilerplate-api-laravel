<?php

Route::prefix('v1')->group(function () {

    Route::prefix('transaction')->group(function () {
        Route::get('search', 'TransactionController@search');
    });
    Route::resource('transaction', 'TransactionController')->except(['create', 'edit']);
});