<?php

namespace App\Http\Middleware;

use App\Models\UniqueUrl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserForm
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAlumniUser = str_contains($request->path(), 'alumni-user');
        $role = $isAlumniUser ? 'alumni_user' : 'alumni';
        $uniqueCode = $request->route('code');

        $uniqueUrl = UniqueUrl::where('unique_code', $uniqueCode)
            ->where('role', $role)
            ->first();

        if (!$uniqueUrl) {
            return redirect('/');
        }

        $nim = $uniqueUrl->nim;

        // ✅ Check if *any* entry with the same NIM has been submitted
        $alreadySubmitted = UniqueUrl::where('nim', $nim)
            ->where('is_submitted', true)
            ->exists();

        if ($alreadySubmitted) {
            return redirect()->route('view.alumni.done');
        }

        return $next($request);
    }

}
