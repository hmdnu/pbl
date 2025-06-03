<?php

namespace App\Http\Controllers;

use App\Exports\AlumniUserSurveyRecapExport;
use App\Exports\AlumniUserSurveyUnfilled;
use App\Models\AlumniEvaluation;
use App\Models\AlumniUserSurvey;
use App\Models\Student;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AlumniUserSurveyController extends Controller
{
    public function index(string $uniqueUrlId, string $code)
    {
        try {
            $nim = UniqueUrl::where('unique_code', $code)->first();
            $student = Student::find($nim->nim);
            $programStudy = Student::with('programStudy')->where('nim', $nim->nim)->first();

            return view('survey.alumni_users.form', [
                'code' => $code,
                'student' => $student,
                'uniqueUrlId' => $uniqueUrlId,
                'program_study' => $programStudy->programStudy->name,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load survey (alumni user)', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Gagal memuat data, silahkan coba lagi']);
        }
    }

    public function store(Request $request, string $uniqueUrlId, string $code)
    {
        $validated = $this->validateForm($request);
        try {
            $evaluation = AlumniEvaluation::create([
                'student_nim' => $validated['student_nim'],
                'teamwork' => $validated['teamwork'],
                'it_expertise' => $validated['it_expertise'],
                'foreign_language' => $validated['foreign_language'],
                'communication' => $validated['communication'],
                'self_development' => $validated['self_development'],
                'leadership' => $validated['leadership'],
                'work_ethic' => $validated['work_ethic'],
                'unmet_competencies' => $validated['unmet_competencies'],
            ]);

            AlumniUserSurvey::create([
                'name' => $validated['name'],
                'institution_type' => $validated['institution_type'],
                'institution_name' => $validated['institution_name'],
                'institution_location' => $validated['institution_location'],
                'institution_scale' => $validated['institution_scale'],
                'position' => $validated['position'],
                'email' => $validated['email'],
                'student_nim' => $validated['student_nim'],
                'alumni_evaluation_id' => $evaluation->id,
                'curriculum_suggestion' => $validated['curriculum_suggestion'],
            ]);

            return redirect()->route('view.alumni.done');
        } catch (\Exception $e) {
            Log::error('Failed to save survey (alumni user)', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data, silahkan coba lagi']);
        }
    }

    private function validateForm(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'institution_type' => 'required|string',
            'institution_name' => 'required|string|max:255',
            'institution_location' => 'required|string|max:255',
            'institution_scale' => 'required|string',
            'position' => 'required|string|max:255',
            'email' => 'required|email',
            'student_nim' => 'required|string|max:50',

            'teamwork' => 'required',
            'it_expertise' => 'required',
            'foreign_language' => 'required',
            'communication' => 'required',
            'self_development' => 'required',
            'leadership' => 'required',
            'work_ethic' => 'required',
            'unmet_competencies' => 'required',
            'curriculum_suggestion' => 'required|string',
        ]);
    }


    public function exportUnfilledRecap(Request $request)
    {
        try {
            return Excel::download(new AlumniUserSurveyUnfilled, 'rekap-pengguna-alumni-belum-isi-survey.xlsx');
        } catch (\Exception $e) {
            Log::error('Failed to export unfilled recap (alumni user)', ['error' => $e->getMessage()]);;
            return back()->withErrors(['error' => 'Gagal mengunduh data, silahkan coba lagi']);
        }
    }

    public function exportAlumniUserSurveyRecap()
    {
        try {
            return Excel::download(new AlumniUserSurveyRecapExport, 'rekap-survey-pengguna-alumni.xlsx');
        } catch (\Exception $e) {
            Log::error('Failed to export recap (alumni user)', ['error' => $e->getMessage()]);;
            return back()->withErrors(['error' => 'Gagal mengunduh data, silahkan coba lagi']);
        }
    }
}
