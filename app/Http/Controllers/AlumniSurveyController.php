<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\AlumniSurvey;
use App\Models\ProfessionCategory;
use App\Models\Student;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;

class AlumniSurveyController extends Controller
{
    public function index(Request $request, string $code)
    {
        $nim = UniqueUrl::where('unique_code', $code)->first();
        $student = Student::find($nim->nim);

        return view('survey.alumni.form', [
            'code' => $code,
            'student' => $student,
            'profession_categories' => ProfessionCategory::all()
        ]);
    }

    public function storeFirstForm(Request $request, string $code)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'nim' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'profession-category' => ['required']
        ]);

        try {
            $professionCategory = ProfessionCategory::find($validated['profession-category']);
            $professionCategoryName = Helper::toKebabCase($professionCategory->name);

            if ($professionCategoryName !== 'belum-bekerja') {
                session([
                    'alumni_form_step_1' => $validated
                ]);
                return redirect()
                    ->route('view.alumni.form.2', ['code' => $code, 'category' => $professionCategoryName]);
            }

            AlumniSurvey::create([
                'student_nim' => $validated['nim'],
                'profession_id' => $validated['profession-category'],
                'phone' => $validated['phone'],
                'email' => $validated['email']
            ]);

            return "sukses";
        } catch (\Exception $error) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data, silahkan coba lagi']);
        }
    }

    public function storeSecondForm(Request $request, string $code, string $category)
    {
        dd(session('alumni_form_step_1'));

        return Helper::toLabel($category);
    }
}