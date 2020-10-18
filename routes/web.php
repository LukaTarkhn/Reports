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
Route::get('/reports', 'App\Http\Controllers\ReportsController@index');
Route::post('/reports', 'App\Http\Controllers\ReportsController@store');
Route::get('/reports/create', 'App\Http\Controllers\ReportsController@create');
Route::get('/reports/{report}', 'App\Http\Controllers\ReportsController@show');
Route::get('/reports/{report}/edit', 'App\Http\Controllers\ReportsController@edit');
Route::put('/reports/{report}', 'App\Http\Controllers\ReportsController@update');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
