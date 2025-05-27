<?php

namespace App\Http\Middleware;

use App\Models\AlumniUserSurvey;
use App\Models\Student;
use App\Models\UniqueUrl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserForm
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = str_contains($request->path(), 'alumni-user') ? 'alumni_user' : 'alumni';

        $exists = UniqueUrl::where('unique_code', $request->route('code'))
            ->where('role', $role)
            ->exists();

        if (!$exists) {
            return redirect('/');
        }

        $nim = UniqueUrl::where('unique_code', $request->route('code'))->first();

        if ($role === 'alumni') {
            return $this->handleAlumni($request, $next, $nim->nim);
        }

        return $this->handleAlumniUser($request, $next, $nim->nim);
    }

    private function handleAlumni(Request $request, Closure $next, string $nim)
    {
        $student = Student::find($nim);
        if ($student->has_filled_survey) {
            return redirect()->route('view.alumni.done');
        }
        return $next($request);
    }

    private function handleAlumniUser(Request $request, Closure $next, string $nim)
    {
        $exist = AlumniUserSurvey::where('student_nim', $nim)->exists();
        if ($exist) {
            return redirect()->route('view.alumni.done');
        }
        return $next($request);
    }
}
