<?php

use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ReceiveTypeController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\RentTypeController;
use App\Http\Controllers\Admin\ReturnTypeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/
 

Route::prefix('admin')->middleware('guest:admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('doLogin');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('login');
});
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {

    Route::get('/index', [LoginController::class, 'index'])->name('index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('branches', BranchesController::class);
    Route::post('/branches/delete', [BranchesController::class, 'delete'])->name('branches.delete');

    Route::resource('ReturnType', ReturnTypeController::class);
    Route::post('/ReturnType/delete', [ReturnTypeController::class, 'delete'])->name('ReturnType.delete');

    Route::resource('RentType', RentTypeController::class);
    Route::post('/RentType/delete', [RentTypeController::class, 'delete'])->name('RentType.delete');

    Route::resource('ReceiveType', ReceiveTypeController::class);
    Route::post('/ReceiveType/delete', [ReceiveTypeController::class, 'delete'])->name('ReceiveType.delete');

    //cars routes
    Route::resource('cars', CarsController::class);
    Route::post('/cars/delete', [CarsController::class, 'delete'])->name('cars.delete');
    Route::post('/maintain', [CarsController::class, 'maintainStore'])->name('maintain.store');
    Route::get('/maintain/{maintain}', [CarsController::class, 'maintainDelete'])->name('maintain.delete');

    //Users
    Route::resource('users', UsersController::class);
    Route::post('/users/delete', [UsersController::class, 'delete'])->name('users.delete');


    //Rents
    Route::resource('rents', RentController::class);
    Route::post('/rents/delete', [RentController::class, 'delete'])->name('rents.delete');


});
