<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Company;
use App\Models\Maintain;
use App\Models\Rent;
use App\Models\RentType;
use App\Models\Service;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $car = Rent::with(['car' => function ($query) {
            $query->select('id', 'type', 'model', 'year');
        }, 'user'=> function ($query) {
            $query->select('id', 'name');
        }] )->latest('id');
        return view('Admin.Rents.index', [
            'rents' => $car->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Rents.create', 
        [
            'cars' =>  Car::all(),
            'users' => User::all(),
            'services' => Service::all(),
            'rent_types' => RentType::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'time' => 'required',
            'location' => 'required',
            'car_id' => 'required',
            'user_id' => 'required',
            'return_type_id' => 'required',
            'services' => 'required|array',
        ]);
        
        unset($validatedData['services']);
        $car = Rent::create($validatedData);

        $car->services()->attach($request->services);
        
        return redirect()->route('admin.rents.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        $rent->load(['car', 'car.files:id,path,fileable_id', 'returnType:id,name', 'user']);

        return view('Admin.Rents.show', ['rent' => $rent]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        return view('Admin.Rents.edit', 
            [
                'rent' => $rent,
                'cars' =>  Car::all(),
                'users' => User::all(),
                'services' => Service::all(),
                'rent_types' => RentType::all(),
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rent $rent)
    {
        $validatedData  = $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'time' => 'required',
            'location' => 'required',
            'car_id' => 'required',
            'user_id' => 'required',
            'return_type_id' => 'required',
            'services' => 'required|array',
        ]);
        
        unset($validatedData['services']);

        $rent->update($validatedData);

        $rent->services()->sync($request->services);

        return redirect()->route('admin.rents.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $rent = Rent::findOrFail($request->id);

        $rent->delete();

        return redirect()->route('admin.rents.index')->with('success', 'تم الحذف بنجاح');

    }

    public function maintainStore(Request $request) {

        $data = $request->validate([
            'amount' => 'required',
            'date' => 'required',
            'description' => 'nullable',
            'car_id' => 'required|exists:cars,id'
        ]);

        Maintain::create($data);

        return redirect()->back()->with('success', 'تم الاضافة بنجاح');

    }

    public function maintaindelete(Maintain $maintain) {

       $maintain->delete();

        return redirect()->back()->with('success', 'تم الحذف بنجاح');

    }
}
