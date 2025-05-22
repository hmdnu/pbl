<?php

namespace App\Http\Controllers;

use App\Mail\SendOtp;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class EmailOtpController extends Controller
{
    public function sendOtpAlumni(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
        ]);

        $email = $validated['email'];
        $mailSender = $this->sendOtp($email);
        session()->put('otp_email', $email);

        return back()
            ->with([
                'message' => $mailSender,
            ])->withInput();
    }

    public function verifyOtpAlumni(Request $request)
    {
        $validated = $request->validate([
            'otp' => ['required'],
            'nim' => ['required']
        ], [
            'otp.required' => 'OTP tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong'
        ]);
        $email = session('otp_email');
        $cache = $this->verifyOtp($email);
        $nim = Student::find($validated['nim']);

        if ($cache === $validated['otp'] && $nim) {
            return redirect()->route('view.alumni.form');
        }

        return back()->with([
            'wrong_otp' => 'OTP salah'
        ]);
    }

    public function sendOtpAlumniUser(Request $request)
    {
    }

    public function verifyOtpAlumniUser(Request $request)
    {
    }

    private function sendOtp($email)
    {
        $otp = rand(100000, 999999);
        $ttlMinutes = 1;

        $cache = Cache::put("otp:{$email}", $otp);
        $mail = Mail::to($email)->send(new SendOtp($otp));

        if (!$cache) {
            return "Internal server error";
        }

        if (!$mail) {
            return "Gagal mengirim email ke {$email}";
        }

        return "Kode OTP berhasil dikirim";
    }

    private function verifyOtp($email)
    {
        return Cache::get("otp:{$email}");
    }
}