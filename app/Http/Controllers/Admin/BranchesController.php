<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Branches.index', [
            'branches' => Branch::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Branches.create');

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
    public function show(string $id)
    {
        //
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

        $branch = Branch::findOrFail($request->id);

        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'تم الحذف بنجاح');

    }
}
