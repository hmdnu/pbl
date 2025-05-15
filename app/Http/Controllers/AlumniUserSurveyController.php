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
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        return redirect('/survey/alumni/form');
    }

    public function submitSurvey(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_instansi' => 'required|string',
            'nama_instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email',
            'nim_mahasiswa' => 'required|string|max:50',

            'kerjasama_tim' => 'required',
            'keahlian_ti' => 'required',
            'bahasa_asing' => 'required',
            'komunikasi' => 'required',
            'pengembangan_diri' => 'required',
            'kepemimpinan' => 'required',
            'etos_kerja' => 'required',
            'kompetensi_kurang' => 'required',
            'saran_kurikulum' => 'required|string',
        ]);

        return "ok";
    }
}
