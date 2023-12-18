<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
// use App\Http\Controllers\Web\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['guest'], 'namespace' => 'Web'], function() {

    // Frontend Pages
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Route::get('/', [HomeController::class, 'index'])->name('home');

});


// Auth::routes();

Route::get('/get-data', 'Admin\UserController@getData')->name('get.data');


