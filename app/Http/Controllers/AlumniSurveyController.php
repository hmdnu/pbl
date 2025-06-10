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

class AlumniSurveyController extends Controller
{
    private const string FORM_1 = 'alumni_form_step_1';

    public function index(Request $request, string $uniqueCodeId, string $code)
    {
        try {
            $nim = UniqueUrl::where('unique_code', $code)->firstOrFail();
            $student = Student::findOrFail($nim->nim);

            return view('survey.alumni.form', [
                'code' => $code,
                'uniqueCodeId' => $uniqueCodeId,
                'student' => $student,
                'profession_categories' => ProfessionCategory::all()
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading alumni form view', ['error' => $e->getMessage()]);
            abort(404, 'Data tidak ditemukan.');
        }
    }

    public function secondForm(Request $request, string $uniqueUrlId, string $code, string $category)
    {
        try {
            $categoryId = $request->query('category-id');
            $professions = Profession::where('category_id', $categoryId)->get();
            $graduationDate = session(self::FORM_1);

            if (!$graduationDate) {
                return redirect('/')->withErrors(['error' => 'Sesi kadaluarsa, silakan mulai kembali.']);
            }

            return view('survey.alumni.second-form', [
                'code' => $code,
                'category' => Helper::toLabel($category),
                'professions' => $professions,
                'uniqueUrlId' => $uniqueUrlId,
                'graduationDate' => $graduationDate['graduation-date']
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading second alumni form', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    public function storeFirstForm(Request $request, string $uniqueUrlId, string $code)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'graduation-date' => ['required'],
            'profession-category' => ['required']
        ]);

        try {
            $professionCategory = ProfessionCategory::findOrFail($validated['profession-category']);
            $professionCategoryName = Helper::toKebabCase($professionCategory->name);

            if ($professionCategoryName !== 'belum-bekerja') {
                session([self::FORM_1 => $validated]);

                return redirect()->route('view.alumni.form.2', [
                    'uniqueUrlId' => $uniqueUrlId,
                    'code' => $code,
                    'category' => $professionCategoryName,
                    'category-id' => $validated['profession-category']
                ]);
            }

            AlumniSurvey::create([
                'student_nim' => $validated['nim'],
                'profession_category_id' => $validated['profession-category'],
                'phone' => $validated['phone'],
                'email' => $validated['email']
            ]);

            Student::where('nim', $validated['nim'])->update(['has_filled_survey' => true]);
            UniqueUrl::findOrFail($uniqueUrlId)->update(['is_submitted' => true]);

            return redirect()->route('view.alumni.done');
        } catch (\Exception $e) {
            Log::error('Failed to store first alumni form', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    public function storeSecondForm(Request $request, string $uniqueUrlId, string $code)
    {
        $validated = $this->validateSecondForm($request);
        $firstFormData = session(self::FORM_1);

        try {
            if (!$firstFormData) {
                return redirect('/')->withErrors(['error' => 'Sesi tidak valid, silakan mulai ulang.']);
            }

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
            UniqueUrl::findOrFail($uniqueUrlId)->update(['is_submitted' => true]);

            return redirect()->route('view.alumni.done');
        } catch (\Exception $e) {
            Log::error('Failed to store second alumni form', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    private function validateSecondForm(Request $request)
    {
        return $request->validate([
            'profession' => ['required'],
            'graduation_date' => ['required'],
            'first_work_date' => ['required'],
            'institution_type' => ['required', 'string', 'max:255'],
            'institution_name' => ['required', 'string', 'max:255'],
            'institution_location' => ['required', 'string', 'max:255'],
            'institution_scale' => ['required', 'string', 'max:255'],
            'first_institution_work_date' => ['required'],
            'supervisor_name' => ['required', 'string', 'max:255'],
            'supervisor_position' => ['required', 'string', 'max:255'],
            'supervisor_email' => ['required', 'email', 'max:255'],
            'waiting_period' => ['required', 'string', 'max:255']
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


    public function exportAlumniSurveyRecap()
    {
        try {
            return Excel::download(new AlumniSurveyRecapExport, 'rekap-survey-alumni.xlsx');
        } catch (\Exception $e) {
            Log::error('Export alumni survey failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Gagal mengunduh rekap data.']);
        }
    }
}
