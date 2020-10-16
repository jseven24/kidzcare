<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::post('/home/link-child', [App\Http\Controllers\LinkedChildController::class, 'linkChild']);
Route::redirect('/home/link-child', '/', 301);


//Route::get('/home/link/ajax', [App\Http\Controllers\LinkedChildController::class, 'ajax']);
Route::post('/formSubmit', [App\Http\Controllers\PostController::class, 'formSubmit']);
Route::redirect('/formSubmit', '/', 301);

Route::resource('children', App\Http\Controllers\ChildController::class);
Route::resource('adults', App\Http\Controllers\AdultController::class);
Route::resource('/home/link', App\Http\Controllers\LinkedChildController::class);//->only(['store']);


//Route::get('/adults/create', [App\Http\Controllers\AdultController::class, 'create'])->middleware('role:user');

Route::middleware('role:user,adult')->group(function () {
    Route::get('/adults/create', [App\Http\Controllers\AdultController::class, 'create']);
    Route::get('/adults/{adult}/edit', [App\Http\Controllers\AdultController::class, 'edit']);
    //Route::get('/adults', [App\Http\Controllers\AdultController::class, 'index'])->withoutMiddleware('role:user,adult');
});

