<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\ProfessionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfessionController extends Controller
{
    public function index()
    {
        try {
            $professions = DB::table('professions')
                ->join('profession_categories', 'professions.category_id', '=', 'profession_categories.id')
                ->select(
                    'professions.id',
                    'professions.category_id',
                    'profession_categories.name as category_name',
                    'professions.name as profession_name'
                )
                ->get();

            $professionCategory = ProfessionCategory::all();

            return view("profession.index", ['professions' => $professions, 'professionCategory' => $professionCategory]);
        } catch (\Exception $e) {
            Log::error("Gagal mengambil data profesi: " . $e->getMessage());
            return back()->with('error', 'Gagal memuat data profesi.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:profession_categories,id',
            'name' => 'required|string|max:255',
        ]);

        try {
            Profession::create([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
            ]);

            return redirect()->back()->with('success', 'Data profesi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Gagal menambahkan profesi: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan profesi.');
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
            $profession = Profession::findOrFail($id);
            $profession->update([
                'name' => $request->input('name'),
            ]);

            return redirect()->back()->with('success', 'Profession berhasil diupdate.');
        } catch (\Exception $e) {
            Log::error("Gagal mengupdate profesi ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profesi.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $profession = Profession::findOrFail($id);
            $profession->delete();

            return redirect()->back()->with('success', 'Data profesi berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Gagal menghapus profesi ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus profesi.');
        }
    }
}
