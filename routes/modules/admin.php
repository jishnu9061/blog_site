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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {

    Auth::routes();
    Route::group(['middleware' => ['auth:admin']], function() {

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

        //page
        Route::get('/page', 'PageController@index')->name('page.index');
        Route::get('/page/create/', 'PageController@create')->name('page.create');
        Route::get('/page/edit/{page}', 'PageController@edit')->name('page.edit');
        Route::put('/page/store', 'PageController@store')->name('page.store');
        Route::put('/page/update/{page}', 'PageController@update')->name('page.update');
        Route::delete('/page/destroy/{page:id}', 'PageController@destroy')->name('page.destroy');
        Route::get('pages', 'PageController@getPage')->name('get-pages');

        //contact us
        Route::group(['prefix' => 'contact-us', 'as' => 'contact-us.'], function () {
            Route::get('/', 'ContactUsController@index')->name('index');
            Route::get('/contact-us/message/{contactUs:id}', 'ContactUsController@message')->name('message');
            Route::get('/get-message', 'ContactUsController@getMessages')->name('get-message');
        });

        //testimonial
        Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
            Route::get('/', 'TestimonialController@index')->name('index');
            Route::get('/create', 'TestimonialController@create')->name('create');
            Route::get('/edit/{testimonial:id}', 'TestimonialController@edit')->name('edit');
            Route::put('/store', 'TestimonialController@store')->name('store');
            Route::put('/update/{testimonial:id}', 'TestimonialController@update')->name('update');
            Route::delete('/destroy/{testimonial:id}', 'TestimonialController@destroy')->name('destroy');
            Route::get('testimonials', 'TestimonialController@getTestimonials')->name('get-testimonials');
        });
    });
});
