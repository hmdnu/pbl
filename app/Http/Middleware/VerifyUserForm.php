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

        if ($uniqueUrl->is_submitted) {
            return redirect()->route('view.alumni.done');
        }

        return $next($request);
    }
}
