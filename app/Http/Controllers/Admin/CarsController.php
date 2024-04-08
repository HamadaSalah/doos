<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Company;
use App\Models\Maintain;
use App\Models\RentType;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Cars.index', [
            'cars' => Car::with('firstFile')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Cars.create', 
        [
            'companies' => Company::all(),
            'rentTypes' => RentType::all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'address' => 'nullable',
        ]);

        Branch::create($validatedData);

        return redirect()->route('admin.branches.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load(['company', 'files:id,path,fileable_id', 'rentTypes:id,name,icon', 'maintains']);

        return view('Admin.Cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('Admin.Branches.edit', ['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validatedData  = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'address' => 'nullable',
        ]);

        $branch->update($validatedData);

        return redirect()->route('admin.branches.index')->with('success', 'تم التعديل بنجاح');
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

        $branch = Car::findOrFail($request->id);

        $branch->delete();

        return redirect()->route('admin.cars.index')->with('success', 'تم الحذف بنجاح');

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
