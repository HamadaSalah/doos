<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Company;
use App\Models\Maintain;
use App\Models\RentType;
use App\Services\UploadService;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $car = Car::with('firstFile')->latest('id');
        if($request->type != null ) {
            $car->where('type', 'LIKE', '%'.$request->type.'%');
        }
        if($request->branch_id != null ) {
            $car->where('branch_id', 'LIKE', '%'.$request->branch_id.'%');
        }
        if($request->status != null ) {
            $car->where('status', 'LIKE', '%'.$request->status.'%');
        }
        return view('Admin.Cars.index', [
            'cars' => $car->paginate(10),
            'branches' => Branch::all()
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
            'branches' => Branch::all(),
            'rentTypes' => RentType::all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'type' => 'required',
            'model' => 'required',
            'year' => 'required',
            'price' => 'required',
            'number' => 'required',
            'assurance' => 'required',
            'kilos' => 'required',
            'with_driver' => 'required',
            'company_id' => 'required',
            'branch_id' => 'required',
            'status' => 'required',
            'rents' => 'required|array',
            'img' => 'required|array'
        ]);

        $car = Car::create($validatedData);

        $car->rentTypes()->attach($request->rents);
        
        foreach ($request->file('img') as $file) {
            $car->files()->create([
                'name' => $file->getClientOriginalName() ?? 'file',
                'path' => UploadService::store($file)
            ]);
        }

        return redirect()->route('admin.cars.index')->with('success', 'تم الحفظ بنجاح');
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
    public function edit(Car $car)
    {
        return view('Admin.Cars.edit', 
            [
                'car' => $car,
                'companies' => Company::all(),
                'rentTypes' => RentType::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validatedData  = $request->validate([
            'type' => 'required',
            'model' => 'required',
            'year' => 'required',
            'price' => 'required',
            'number' => 'required',
            'assurance' => 'required',
            'kilos' => 'required',
            'with_driver' => 'required',
            'company_id' => 'required',
            'rents' => 'required|array',
        ]);

        $car->update($validatedData);

        $car->rentTypes()->sync($request->rents);
        
        if($request->file('img') != NULL) {
            $car->files()->delete();
            foreach ($request->file('img') as $file) {
                $car->files()->create([
                    'name' => $file->getClientOriginalName() ?? 'file',
                    'path' => UploadService::store($file)
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'تم التعديل بنجاح');
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
