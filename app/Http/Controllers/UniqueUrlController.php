<?php

namespace App\Http\Controllers;

use App\Mail\SendOtp;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UniqueUrlController extends Controller
{
    private function generateUniqueUrl(string $host, string $role): string
    {
        $uniqueCode = rand(100000, 999999);
        $storedRole = $role === 'alumni-user' ? 'alumni_user' : $role;

        UniqueUrl::create([
            'unique_code' => $uniqueCode,
            'role' => $storedRole,
        ]);

        return "$host/survey/form/$role/$uniqueCode";
    }

    private function sendSurveyLink(string $role, string $email, string $host): bool
    {
        $url = $this->generateUniqueUrl($host, $role);
        Mail::to($email)->send(new SendOtp($url));
        return true;
    }

    private function validateEmail(Request $request): string
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
        ]);

        return $data['email'];
    }

    public function sendEmail(Request $request, string $role)
    {
        $email = $this->validateEmail($request);
        $roles = ['alumni', 'alumni-user'];

        try {
            if (!in_array($role, $roles)) {
                return redirect('/');
            }

            $this->sendSurveyLink($role, $email, $request->getHost());

            return back()->with([
                'message' => "Link survey berhasil dikirim, silahkan cek email anda",
            ])->withInput();
        } catch (\Exception $e) {
            return back()->with([
                'message' => 'Gagal mengirim email, silahkan coba lagi',
            ])->withInput();
        }
    }
}