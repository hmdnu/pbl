<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudyProgramController extends Controller
{
    public function index()
    {
        return view("admin.program_study.index", ["programstudies" => ProgramStudy::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            ProgramStudy::create([
                'name' => $request->input('name'),
            ]);

            return back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan program studi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan data');
        }
    }

    public function create()
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $programStudy = ProgramStudy::findOrFail($id);
            $programStudy->update([
                'name' => $request->input('name'),
            ]);

            return back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui program studi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(string $id)
    {
        try {
            $programStudy = ProgramStudy::findOrFail($id);
            $programStudy->delete();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus program studi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
