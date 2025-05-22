<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudy;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view("ProgramStudy.index", ["programstudies"=>ProgramStudy::all()] );
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
        'name' => 'required|string|max:255',
    ]);

    ProgramStudy::create([
        'name' => $request->input('name'),
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
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
    public function update(Request $request, string $id)
    {
       $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $programStudy = ProgramStudy::findOrFail($id);
        $programStudy->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $programStudy = ProgramStudy::findOrFail($id);
        $programStudy->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    
    }
}
