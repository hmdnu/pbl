<?php

namespace App\Http\Controllers;

use App\Exports\AlumniSurveyRecapExport;
use App\Helpers\Helper;
use App\Models\AlumniSurvey;
use App\Models\Profession;
use App\Models\ProfessionCategory;
use App\Models\Student;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class AlumniSurveyController extends Controller
{
    private const string FORM_1 = 'alumni_form_step_1';

    public function index(Request $request, string $uniqueCodeId, string $code)
    {
        $nim = UniqueUrl::where('unique_code', $code)->first();
        $student = Student::find($nim->nim);

        return view('survey.alumni.form', [
            'code' => $code,
            'uniqueCodeId' => $uniqueCodeId,
            'student' => $student,
            'profession_categories' => ProfessionCategory::all()
        ]);
    }

    public function secondForm(Request $request, string $uniqueUrlId, string $code, string $category)
    {
        $categoryId = $request->query('category-id');
        $professions = Profession::where('category_id', $categoryId)->get();
        $graduationDate = session(self::FORM_1);

        if (!$graduationDate) {
            return redirect('/');
        }

        return view('survey.alumni.second-form', [
            'code' => $code,
            'category' => Helper::toLabel($category),
            'professions' => $professions,
            'uniqueUrlId' => $uniqueUrlId,
            'graduationDate' => $graduationDate['graduation-date']
        ]);
    }

    public function storeFirstForm(Request $request, string $uniqueUrlId, string $code)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'nim' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'graduation-date' => ['required',],
            'profession-category' => ['required']
        ]);

        try {
            $professionCategory = ProfessionCategory::find($validated['profession-category']);
            $professionCategoryName = Helper::toKebabCase($professionCategory->name);

            if ($professionCategoryName !== 'belum-bekerja') {
                session([self::FORM_1 => $validated]);

                return redirect()->route('view.alumni.form.2', [
                    'uniqueUrlId' => $uniqueUrlId, // ✅ Corrected key
                    'code' => $code,
                    'category' => $professionCategoryName,
                    'category-id' => $validated['profession-category']
                ]);
            }

            // save survey unemployed
            AlumniSurvey::create([
                'student_nim' => $validated['nim'],
                'profession_category_id' => $validated['profession-category'],
                'phone' => $validated['phone'],
                'email' => $validated['email']
            ]);

            //  update has submitting
            Student::where('nim', $validated['nim'])->update(['has_filled_survey' => true]);
            UniqueUrl::find($uniqueUrlId)->update(['is_submitted' => true]);
            
            return redirect()->route('view.alumni.done');
        } catch (\Exception $error) {
            Log::error('Failed to save survey (alumni 1st form)', ['error' => $error->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data, silahkan coba lagi']);
        }
    }

    public function storeSecondForm(Request $request, string $uniqueUrlId, string $code)
    {
        $validated = $this->validateSecondForm($request);
        $firstFormData = session(self::FORM_1);
        try {
            AlumniSurvey::create([
                'student_nim' => $firstFormData['nim'],
                'profession_category_id' => $firstFormData['profession-category'],
                'profession_id' => $validated['profession'],
                'phone' => $firstFormData['phone'],
                'email' => $firstFormData['email'],
                'first_work_date' => $validated['first_work_date'],
                'waiting_period' => $validated['waiting_period'],
                'institution_type' => $validated['institution_type'],
                'institution_name' => $validated['institution_name'],
                'institution_location' => $validated['institution_location'],
                'first_institution_work_date' => $validated['first_institution_work_date'],
                'supervisor_name' => $validated['supervisor_name'],
                'supervisor_position' => $validated['supervisor_position'],
                'supervisor_email' => $validated['supervisor_email'],
            ]);
            Student::where('nim', $firstFormData['nim'])->update(['has_filled_survey' => true]);
            UniqueUrl::find($uniqueUrlId)->update(['is_submitted' => true]);

            return redirect()->route('view.alumni.done');
        } catch (\Exception $error) {
            Log::error('Failed to save survey (alumni 2nd form)', ['error' => $error->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data, silahkan coba lagi']);
        }
    }

    private function validateSecondForm(Request $request)
    {
        return $request->validate([
            'profession' => ['required'],
            'graduation_date' => ['required'],
            'first_work_date' => ['required'],
            'institution_type' => ['required'],
            'institution_name' => ['required', 'string', 'max:255'],
            'institution_location' => ['required', 'string', 'max:255'],
            'institution_scale' => ['required'],
            'first_institution_work_date' => ['required'],
            'supervisor_name' => ['required', 'string', 'max:255'],
            'supervisor_position' => ['required', 'string', 'max:255'],
            'supervisor_email' => ['required', 'email'],
            'waiting_period' => ['required']
        ], [
            'profession.required' => 'Profesi wajib diisi.',
            'graduation_date.required' => 'Tanggal lulus wajib diisi',
            'first_work_date.required' => 'Tanggal pertama kali bekerja wajib diisi.',
            'institution_type.required' => 'Jenis instansi wajib dipilih.',
            'institution_name.required' => 'Nama instansi wajib diisi.',
            'institution_location.required' => 'Alamat instansi wajib diisi.',
            'first_institution_work_date.required' => 'Tanggal masuk instansi saat ini wajib diisi.',
            'supervisor_name.required' => 'Nama atasan langsung wajib diisi.',
            'supervisor_position.required' => 'Jabatan atasan langsung wajib diisi.',
            'supervisor_email.required' => 'Email atasan langsung wajib diisi.',
            'supervisor_email.email' => 'Format email atasan tidak valid.',
            'waiting_period.required' => 'Masa tunggu wajib diisi'
        ]);
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportAlumniSurveyRecap()
    {
        return Excel::download(new AlumniSurveyRecapExport, 'rekap-survey-alumni.xlsx');
    }
}
