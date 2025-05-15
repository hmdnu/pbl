<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.index", ["admins"=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|min:3|unique:users,nip',
            'name' => 'required|string|max:100', 
            'password' => 'required|min:5', 
        ]);

        User::create([
            'nip' => $request->input('nip'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')), 
        ]);

        return redirect()->back()->with('success', 'Data user berhasil disimpan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nip)
    {
        $request->validate([
            'name' => 'required|string|max:100',  
        ]);

        $admin = User::findOrFail($nip);
        $admin->update([
            'name'=> $request->input('name'),
        ]);

        return redirect()->back()->with('success', 'Data user berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $admin = User::findOrFail($nip);
        $admin->delete();

        return redirect()->back()->with('success', 'Data user berhasil disimpan');

    }
}
