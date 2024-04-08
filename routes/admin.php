<?php

use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\LoginController;
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

    Route::resource('branches', BranchesController::class);
    Route::post('/branches/delete', [BranchesController::class, 'delete'])->name('branches.delete');

    //cars routes
    Route::resource('cars', CarsController::class);
    Route::post('/cars/delete', [CarsController::class, 'delete'])->name('cars.delete');
    Route::post('/maintain', [CarsController::class, 'maintainStore'])->name('maintain.store');
    Route::get('/maintain/{maintain}', [CarsController::class, 'maintainDelete'])->name('maintain.delete');


});
