<?php

namespace App\Http\Middleware;

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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
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
        $student = Student::find($nim->nim);

        if ($student->has_filled_survey) {
            return redirect()->route('view.alumni.done');
        }

        return $next($request);
    }
}