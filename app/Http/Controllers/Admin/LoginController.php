<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('Admin.login');
    }
    public function dologin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $rememberme = $request->rememberme;
        if (auth()->guard('admin')->attempt(['email' => $email, 'password' => $password], $rememberme)) {
            return redirect('admin/index');
        }
        else {
            session()->flash('error', 'Wrong Email Or Password');
            return redirect('admin/login');
        }
    }
    public function index()
    {
        $cars = Car::whereNotNull('lat')->whereNotNull('long')->get();
        
        $mycars = $cars->map(function ($car) {
            return [
                "name" => $car->type . " " . $car->model . " " . $car->number,
                "lat" => (double)$car->lat,
                "lng" => (double)$car->long,
            ];
        })->all();
        
        return view('Admin.index', [
            'title' => 'الرئيسية',
            'cars' => $mycars,
            'usersCount' => User::count(),
            'branchesCount' => Branch::count(),
            'carsCount' => Car::count(),
            'rentsCount' => Rent::count(),
        ]);
    }


    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
