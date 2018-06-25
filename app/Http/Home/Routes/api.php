<?php

Route::prefix('v1')->group(function () {
    Route::resource('configuration', 'ConfigurationController')->except(['destroy','create', 'edit', 'show']);

    Route::prefix('testimony')->group(function () {
        Route::get('search', 'TestimonyController@search');
    });
    Route::resource('testimony', 'TestimonyController')->except(['create', 'edit']);

    Route::prefix('faq')->group(function () {
        Route::get('search', 'FaqController@search');
    });
    Route::resource('faq', 'FaqController')->except(['create', 'edit']);

    Route::prefix('information')->group(function () {
        Route::get('search', 'HomeController@search');
    });
    Route::resource('information', 'HomeController')->except(['create', 'edit']);

});