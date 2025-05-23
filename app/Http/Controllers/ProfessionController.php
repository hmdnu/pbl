<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;

class ProfessionController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
{
    $professions = DB::table('professions')
        ->join('profession_categories', 'professions.category_id', '=', 'profession_categories.id')
        ->select(
            'professions.id',
            'professions.category_id',
            'profession_categories.name as category_name',
            'professions.name as profession_name'
        )
        ->get();

    return view("profession.index", compact('professions'));
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
        // Validasi input
    $request->validate([
        'category_id' => 'required|exists:profession_categories,id',
        'name' => 'required|string|max:255',
    ]);

    // Simpan ke database
    Profession::create([
        'category_id' => $request->input('category_id'),
        'name' => $request->input('name'),
    ]);

    // Kembali ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Data profesi berhasil ditambahkan.');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

         $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $profession = Profession::findOrFail($id);
    $profession->update([
        'name' => $request->input('name'),
    ]);

    return redirect()->back()->with('success', 'Profession berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari dan hapus data profession berdasarkan id
    $profession = Profession::findOrFail($id);
    $profession->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Data profesi berhasil dihapus.');
    }
}
