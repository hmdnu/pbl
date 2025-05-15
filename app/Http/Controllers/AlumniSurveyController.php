<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniSurveyController extends Controller
{
    public function showform()
    {
        return view('survey.alumni.form');
    }

    public function showValidation()
    {
        return view('survey.alumni.validation');
    }

    public function submitValidation(Request $request)
    {
        return redirect("/survey/alumni/form ");
    }

    public function submitForm()
    {
        return "ok";
    }
}