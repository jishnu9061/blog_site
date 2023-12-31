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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Auth::routes();
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', 'HomeController@index')->name('home');

        // Category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::get('/edit/{category}', 'CategoryController@edit')->name('edit');
            Route::post('/store', 'CategoryController@store')->name('store');
            Route::put('/update/{category}', 'CategoryController@update')->name('update');
            Route::delete('/delete/{category}', 'CategoryController@destroy')->name('destroy');
        });

        // Tag
        Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
            Route::get('/', 'TagController@index')->name('index');
            Route::get('/create', 'TagController@create')->name('create');
            Route::get('/edit/{tag}', 'TagController@edit')->name('edit');
            Route::post('/store', 'TagController@store')->name('store');
            Route::put('/update/{tag}', 'TagController@update')->name('update');
            Route::delete('/delete/{tag}', 'TagController@destroy')->name('destroy');
        });

        // Article
        Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
            Route::get('/', 'ArticleController@index')->name('index');
            Route::get('/create', 'ArticleController@create')->name('create');
            Route::get('/edit/{article}', 'ArticleController@edit')->name('edit');
            Route::post('/store', 'ArticleController@store')->name('store');
            Route::put('/update/{article}', 'ArticleController@update')->name('update');
            Route::delete('/delete/{article}', 'ArticleController@destroy')->name('destroy');
        });

        // User
        Route::resource('user', 'UserController');
        Route::get('/user/{id}', 'UserController@show')->name('view-data');
        Route::get('/user/notification/{id}', 'UserController@notification')->name('view-notification');

        //profile
        Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
        Route::get('/profile/change-password', 'ProfileController@viewChangePassword')->name('profile.change-password');
        Route::put('/profile/update-password', 'ProfileController@updatePassword')->name('profile.update-password');
        Route::put('/profile/update-image', 'ProfileController@updateImage')->name('profile.update-image');
        Route::get('/profile/recent-login', 'ProfileController@viewRecentLogin')->name('profile.recent-login');
    });
});
