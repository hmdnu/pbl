<?php

namespace App\Http\Controllers;

use App\Mail\SendUniqueUrl;
use App\Models\Student;
use App\Models\UniqueUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UniqueUrlController extends Controller
{
    private const array ROLES = ['alumni', 'alumni-user'];

    public function sendEmail(Request $request, string $role)
    {
        if (!in_array($role, self::ROLES)) {
            return redirect('/');
        }

        $email = $this->validateEmail($request);
        $nim = $this->validateAndGetNim($request);

        if (!$nim) {
            return back()->withErrors([
                'nim' => 'NIM tidak ditemukan',
            ])->withInput();
        }

        try {
            $this->sendSurveyLink($role, $email, $request->getHost(), $nim);

            return back()->with([
                'message' => 'Link survey berhasil dikirim, silahkan cek email anda',
            ])->withInput();
        } catch (\Throwable $e) {
            \Log::error('Failed to send survey link', ['error' => $e->getMessage()]);

            return back()->with([
                'message' => 'Gagal mengirim email, silahkan coba lagi',
            ])->withInput();
        }
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

    private function validateAndGetNim(Request $request): ?string
    {
        $data = $request->validate([
            'nim' => ['required'],
        ], [
            'nim.required' => 'NIM tidak boleh kosong',
        ]);

        return Student::where('nim', $data['nim'])->value('nim');
    }

    private function sendSurveyLink(string $role, string $email, string $host, string|null $nim): void
    {
        $url = $this->generateUniqueUrl($host, $role, $nim);
        Mail::to($email)->send(new SendUniqueUrl($url, $role));
    }

    private function generateUniqueUrl(string $host, string $role, string|null $nim): string
    {
        $uniqueCode = Str::random(8);
        $storedRole = $role === 'alumni-user' ? 'alumni_user' : $role;

        $uniqueUrl = UniqueUrl::create([
            'unique_code' => $uniqueCode,
            'role' => $storedRole,
            'nim' => $nim
        ]);

        $uniqueUrlId = $uniqueUrl->id;
        return "$host/survey/form/$role/$uniqueUrlId/$uniqueCode";
    }
}
