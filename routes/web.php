<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserDashboardController;
use App\Models\User;
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

//Login action
Route::post('/authenticate', [AuthenticationController::class, 'authenticate']);

//Register action
Route::post('/register', [AuthenticationController::class, 'register']);

//Logout action
Route::post('/logout', [AuthenticationController::class, 'logout']);

//Home -> shows login page if user is not logged in
Route::get('/', [AuthenticationController::class, 'show_authentication'])->middleware('guest');

//Registration form
Route::get('/registration', [AuthenticationController::class, 'show_registration']);

//User dashboard page
Route::get('/user-dashboard', [UserDashboardController::class, 'show'])->name('user-dashboard');

//Create product action
Route::post('/product/create', [UserDashboardController::class, 'create']);

//Delete product action
Route::delete('product/delete/{product}', [UserDashboardController::class, 'delete']);

//Show the edit form
Route::post('/product/show-edit-form/{product}', [UserDashboardController::class, 'show_edit_form']);

//Update product action
Route::put('/product/edit/{product}', [UserDashboardController::class, 'update']);