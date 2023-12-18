<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'user', 'namespace' => 'User','as' => 'user.'], function() {

    // User Dashboard pages
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware' => ['auth:user']], function() {
        Route::get('/', 'HomeController@index')->name('home');


        //Profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('index');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::get('/change-password', 'ProfileController@viewChangePassword')->name('change-password');
            Route::put('/update-password', 'ProfileController@updatePassword')->name('update-password');
            Route::put('/update-image', 'ProfileController@updateImage')->name('update-image');
            Route::get('/recent-login', 'ProfileController@viewRecentLogin')->name('recent-login');
        });

    });
});
