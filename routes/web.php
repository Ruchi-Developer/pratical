<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => 'guest'], function(){

Route::get('/get-countries', [UserController::class, 'fetchCountries'])->name('get.countries');
Route::get('/get-states', [UserController::class, 'fetchStates'])->name('get.states');
Route::get('/get-cities', [UserController::class, 'fetchCities'])->name('get.cities');


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'store'])->name('register');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [AuthController::class, 'view'])->name('home');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});