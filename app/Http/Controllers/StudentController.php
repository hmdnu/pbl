<?php

namespace App\Http\Controllers;

use App\Exports\StudentSurveyUnfilledExport;
use App\Imports\StudentImport;
use App\Models\ProgramStudy;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the students with optional filters.
     */
    public function index(Request $request)
    {
        $prodi = $request->input('prodi');
        $tahun = $request->input('tahun');

        $students = Student::with('programStudy')
            ->when($prodi, fn($q) => $q->where('program_study_id', $prodi))
            ->when($tahun, fn($q) => $q->whereYear('graduation_date', $tahun))
            ->get();

        $program_studies = ProgramStudy::all();

        return view('admin.student.index', compact('students', 'program_studies', 'prodi', 'tahun'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:students,nim',
            'name' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'program_study_id' => 'required|exists:program_studies,id',
        ]);

        $validated['graduation_date'] = Carbon::parse($validated['graduation_date']);

        try {
            Student::create($validated);
            return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Student store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        
    }

    /**
     * Display the specified student.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified student in storage.
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

        $validated['graduation_date'] = Carbon::parse($validated['graduation_date']);

        try {
            $student->update($validated);
            return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Student update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::where('nim', $id)->firstOrFail();
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Student delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    /**
     * Import students from an Excel file.
     */
    public function import(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new StudentImport, $validated['file']);
            return back()->with('success', 'Data mahasiswa berhasil diimport.');
        } catch (\Exception $e) {
            Log::error('Student import error: ' . $e->getMessage());
            return back()
                ->with('error', 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function exportStudentUnfilled(Request $request)
    {
        try {
            return Excel::download(new StudentSurveyUnfilledExport, 'mahasiswa-belum-isi-survey.xlsx');
        } catch (\Exception $e) {
            \Log::error('Export error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
