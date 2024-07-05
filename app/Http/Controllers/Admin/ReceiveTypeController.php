<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ReceiveType;
use Illuminate\Http\Request;

class ReceiveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.ReceiveType.index', [
            'branches' => ReceiveType::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.ReceiveType.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'name' => 'required',
        ]);

        ReceiveType::create($validatedData);

        return redirect()->route('admin.ReceiveType.index')->with('success', 'تم الحفظ بنجاح');
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
    public function edit($id)
    {
        $branch = ReceiveType::findOrFail($id);

        return view('Admin.ReceiveType.edit', ['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'name' => 'required',
        ]);

        $type = ReceiveType::findOrFail($id);

        $type->update($validatedData);

        return redirect()->route('admin.ReceiveType.index')->with('success', 'تم التعديل بنجاح');
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

        $branch = ReceiveType::findOrFail($request->id);

        $branch->delete();

        return redirect()->route('admin.ReceiveType.index')->with('success', 'تم الحذف بنجاح');

    }
}
