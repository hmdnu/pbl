<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProgramStudy;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('programStudy')->get();
        $program_studies = ProgramStudy::all();

        return view('admin.student.index', compact('students', 'program_studies'));
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
        $validated = $request->validate([
            'nim' => 'required|unique:students,nim',
            'name' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'program_study_id' => 'required|exists:program_studies,id',
        ]);

        $validated['graduation_date'] = Carbon::parse('dd-mm-yyyy');

        try {
            Student::create($validated);
            return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
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
        $student = Student::where('nim', $id)->firstOrFail();

        $validated = $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->nim . ',nim',
            'name' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'program_study_id' => 'required|exists:program_studies,id',
        ]);

        try {
            $student->update($validated);
            return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::where('nim', $id)->firstOrFail();
            $student->delete();

            return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
