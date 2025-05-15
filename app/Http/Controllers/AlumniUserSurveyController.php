<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniUserSurveyController extends Controller
{
    public function showAgreement()
    {
        return view('survey.alumni_users.agreement');
    }

    public function showForm()
    {
        return view('survey.alumni_users.form');
    }

    public function submitAgreement(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        return redirect('/survey/alumni/form');
    }

    public function submitSurvey(Request $request)
    {
        $validated = $request->validate([
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

        return "ok";
    }
}
