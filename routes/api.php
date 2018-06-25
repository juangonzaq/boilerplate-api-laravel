<?php
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('404', function() {
        return response()->json(['user' => 'guest', 'access' => false]);
    })->name('login');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/{provider}', 'AuthController@redirectProvider');
    Route::get('signup/{provider}/callback', 'AuthController@signupProvider');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
    /*
    Route::post('password/email', 'ForgotPasswordController@getResetToken');
    Route::post('password/reset', 'ResetPasswordController@reset');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('editprofile', 'AuthController@editProfile');
        Route::post('deactivate', 'AuthController@deactivate');
    });
    */
});