<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailOtpController extends Controller
{
    public function showform() {
        return view('survey.alumni.otp');
    }

    public function sendOtp(Request $request) {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email'
        ]);

        $otp = rand(100000, 999999);

        Session::put('otp', $otp);
        Session::put('alumni_data', $request->only('nama', 'nim', 'email'));

        // Kirim OTP via email
        Mail::raw("Kode OTP Anda: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Kode OTP Survey Alumni');
        });

        return redirect()->back()->with('success', 'Kode OTP dikirim ke email.');
    }

    public function verifyOtp(Request $request) {
        $request->validate([
            'otp' => 'required'
        ]);
}
public function submit(Request $request)
{
    // Validasi dan simpan data
    // $request->validate([...]);
    // Model::create([...]);

    // Redirect ke halaman form (atau halaman lain) dengan pesan sukses
    return redirect()->route('/form')->with('success', 'Data berhasil disimpan!');
}




}
