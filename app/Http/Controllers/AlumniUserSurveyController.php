<?php

namespace App\Http\Controllers;

use App\Exports\AlumniUserSurveyRecapExport;
use App\Models\AlumniEvaluation;
use App\Models\AlumniUserSurvey;
use App\Models\Student;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class AlumniUserSurveyController extends Controller
{
    public function index(string $code)
    {
        $nim = UniqueUrl::where('unique_code', $code)->first();
        $student = Student::find($nim->nim);
        $programStudy = Student::with('programStudy')->where('nim', $nim->nim)->first();

        return view('survey.alumni_users.form', [
            'code' => $code,
            'student' => $student,
            'program_study' => $programStudy->programStudy->name,
        ]);
    }

    public function store(Request $request)
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
                'position' => $validated['position'],
                'email' => $validated['email'],
                'student_nim' => $validated['student_nim'],
                'alumni_evaluation_id' => $evaluation->id,
                'curriculum_suggestion' => $validated['curriculum_suggestion'],
            ]);

//            dd('ok');
            return redirect()->route('view.alumni.done');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    private function validateForm(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'institution_type' => 'required|string',
            'institution_name' => 'required|string|max:255',
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

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportAlumniUserSurveyRecap()
    {
        return Excel::download(new AlumniUserSurveyRecapExport, 'rekap-survey-pengguna-alumni.xlsx');
    }
}
