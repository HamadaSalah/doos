<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Users.index', [
            'users' => User::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'birthday' => 'required',
            'id_number' => 'required',
            // 'id_number_file' => 'required',
            'licence_status' => 'required',
            // 'licence_file' => 'required',
            'photo' => 'required',
        ]);

        if($request->hasFile('id_number_file')) {
            $validatedData['id_number_file'] =  UploadService::store($request->id_number_file);
        }
        if($request->hasFile('licence_file')) {
            $validatedData['licence_file'] =  UploadService::store($request->licence_file);
        }
        if($request->hasFile('photo')) {
            $validatedData['photo'] =  UploadService::store($request->photo);
        }

        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'تم الحفظ بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('rents');
        return view('Admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {

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

        $branch = User::findOrFail($request->id);

        $branch->delete();

        return redirect()->route('admin.users.index')->with('success', 'تم الحذف بنجاح');

    }
}
