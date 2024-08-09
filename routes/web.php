<?php

use App\Models\CarBrand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
 

Route::get('/', function () {



    // return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('testt', function(){

    $response = Http::get('https://private-anon-75524369b4-carsapi1.apiary-mock.com/manufacturers');
    $manufacturers = $response->json();

    foreach ($manufacturers as $manufacturer) {
        
        CarBrand::create(['name' => $manufacturer['name']]);

    }

});