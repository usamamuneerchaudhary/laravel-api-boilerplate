<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'firewall.all'], function () {


    Route::post('login', 'API\\Auth\\LoginController@login');
    Route::post('register', 'API\\Auth\\RegisterController@register');
    Route::post('recover', 'API\\Auth\\ResetPasswordController@recover');
    Route::get('find/{token}', 'API\\Auth\\ResetPasswordController@find');
    Route::post('reset', 'API\\Auth\\ResetPasswordController@reset');

    //Auth Routes here
    Route::middleware('auth:api')->group(function () {


        Route::get('logout', 'API\\Auth\\LoginController@logout');
        Route::get('/user/verify/email/{token}', 'API\\Auth\VerificationController@verifyUserByEmail');
    });


});

